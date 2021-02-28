<?php

namespace App\Http\Controllers;

use App\Services\CollectionPaginator;
use App\Http\Requests\StoreCar;
use App\Models\Car;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SKAgarwal\GoogleApi\PlacesApi;

class CarsController extends Controller
{
    public function index()
    {
        return view('cars/index', ['cars' => Car::orderBy('created_at', 'desc')->paginate(12)->onEachSide(1)]);
    }

    public function create()
    {
        return view('cars/create', ['makes' => CarMake::all(), 'models' => CarModel::all()]);
    }

    public function store(StoreCar $request, PlacesApi $place)
    {
        $validated = $request->validated();

        $carData = (new CarService())->carData($validated, $place);
        $placeData = (new CarService())->placeData($validated['place_id'], $place);
        $imageData = collect($request->file('image'));

        $car = Car::create($carData);

        $car->place()->createMany($placeData);

        $imageData->each(function ($image) use ($car) {
            $path = $image->store('uploads', 's3');
            $car->uploads()->create(['filename' => basename($path), 'url' => Storage::url($path)]);
        });

        return redirect(route('car/show', ['car' => $car->id]));
    }

    public function show(Car $car)
    {
        return view('cars/show', ['car' => $car]);
    }

    public function showByPlace(Request $request)
    {
        $cars = Car::where('place_id', $request->place_id)->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);
        return view('cars/index', ['cars' => $cars, 'location' => $cars[0]->location]);
    }

    public function edit(Car $car)
    {
        return view('cars/edit', ['car' => $car, 'makes' => CarMake::all(), 'models' => CarModel::all()]);
    }

    public function update(StoreCar $request, Car $car, PlacesApi $place)
    {
        $validated = $request->validated();

        $carData = (new CarService())->carData($validated, $place);
        $carData['imagesAdded'] = !empty($request->file('image'));
        
        $car->update($carData);

        if ($car->wasChanged('place_id')) {
            $placeData = (new CarService())->placeData($car->place_id, $place);
            $car->place()->createMany($placeData);
        }

        if (!empty($request->file('image'))) {
            $imageData = collect($request->file('image'));
            $imageData->each(function ($image) use ($car) {
                $path = $image->store('uploads', 's3');
                $car->uploads()->create(['filename' => basename($path), 'url' => Storage::url($path)]);
            });
        }
        
        return redirect(route('car/show', ['car' => $car->id]));
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect(route('user/show', Auth::id()));
    }

    public function search(Request $request, PlacesApi $place)
    {
        $keywords = collect(explode(' ', $request->q))->filter(function ($value) {
            return !empty($value);
        });

        $cars = Car::query();
        $carsCollection = collect([]);

        if ($request->option == 'cars' || !isset($request->option)) {
            foreach ($keywords as $keyword) {
                $response = $place->placeAutocomplete($keyword);
                $place_id = $response['predictions'][0]['place_id'] ?? null;

                $cars = $cars->whereHas('carModel', function ($model) use ($keyword) {
                    $model->where('car_models.name', 'like', "%$keyword%");
                })->orWhereHas('carMake', function ($make) use ($keyword) {
                    $make->where('car_makes.name', 'like', "%$keyword%");
                })->orWhereHas('user', function ($user) use ($keyword) {
                    $user->where('users.name', 'like', "%$keyword%");
                });

                if ($place_id) {
                    $cars->orwhereHas('place', function ($place) use ($place_id) {
                        $place->where('place_id', $place_id);
                    });
                }

                $carsCollection->push($cars->orderBy('created_at', 'desc')->get());
            }

            $cars = $carsCollection->flatten()->groupBy('id')->sortDesc()->flatten()->unique();
            $cars = CollectionPaginator::paginate($cars, 12);
        }

        if ($request->option == 'locations') {
            $response = $place->placeAutocomplete($request->q);
            $place_id = $response['predictions'][0]['place_id'] ?? false;

            $cars = $cars->whereHas('place', function ($place) use ($place_id) {
                $place->where('place_id', $place_id);
            })->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);
        }

        if ($request->option == 'makes') {
            $cars = $cars->whereHas('carMake', function ($make) use ($request) {
                $make->where('car_makes.name', 'like', "%$request->q%");
            })->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);
        }

        if ($request->option == 'models') {
            $cars = $cars->whereHas('carModel', function ($model) use ($request) {
                $model->where('car_models.name', 'like', "%$request->q%");
            })->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);
        }

        if ($request->option == 'users') {
            $cars = $cars->whereHas('user', function ($user) use ($request) {
                $user->where('users.name', 'like', "%$request->q%");
            })->orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);
        }

        $cars->appends(['q' => $request->q, 'option' => $request->option]);

        return view('cars/results', ['cars' => $cars]);
    }
}
