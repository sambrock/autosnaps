<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Place;
use App\Services\CarService;
use Illuminate\Database\Eloquent\Factories\Factory;
use SKAgarwal\GoogleApi\PlacesApi;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $places = array(
            array('ChIJEcHIDqKw2YgRZU-t3XHylv8', 'Miami, FL, USA', -80.1917902, 25.7616798),
            array('ChIJd7zN_thz54gRnr-lPAaywwo', 'Orlando, FL, USA', -81.3792365, 28.5383355),
            array('ChIJU0sSh1GK7IgR-LH91HoH7us', 'Tallahassee, FL, USA', -84.28073289999999, 30.4382559),
            array('ChIJE9on3F3HwoAR9AhGJW_fL-I', 'Los Angeles, CA, USA', -118.2436849, 34.0522342),
            array('ChIJkfu1cFLkjYARXj1K2AlJSO4', 'Monterey, CA, USA', -121.8946761, 36.6002378),
            array('ChIJzxcfI6qAa4cR1jaKJ_j0jhE', 'Denver, CO, USA', -104.990251, 39.7392358),
            array('ChIJOwg_06VPwokRYv534QaPC8g', 'New York, NY, USA', -74.0059728, 40.7127753),
            array('ChIJdd4hrwug2EcRmSrV3Vo6llI', 'London, UK', -0.1277583, 51.5073509),
            array('ChIJD7fiBh9u5kcRYJSMaMOCCwQ', 'Paris, France', 2.3522219, 48.856614),
            array('ChIJMS2FahDQzRIRcJqX_aUZCAQ', 'Nice, France', 7.261953200000001, 43.7101728),
            array('ChIJXSModoWLGGARILWiCfeu2M0', 'Tokyo, Japan', 139.7690174, 35.6803997),
            array('ChIJP3Sa8ziYEmsRUKgyFmh9AQM', 'Sydney NSW, Australia', 151.2092955, -33.8688197),
            array('ChIJ90260rVG1moRkM2MIXVWBAQ', 'Melbourne VIC, Australia', 144.9630576, -37.8136276),
            array('ChIJybDUc_xKtUYRTM9XV8zWRD0', 'Moscow, Russia', 37.6173, 55.755826),
            array('ChIJAVkDPzdOqEcRcDteW0YgIQQ', 'Berlin, Germany', 13.404954, 52.52000659999999),
            array('ChIJ04-twTTbmUcR5M-RdxzB1Xk', 'Stuttgart, Germany', 9.1829321, 48.7758459),
            array('ChIJGaK-SZcLkEcRA9wf5_GNbuY', 'Zürich, Switzerland', 8.541694, 47.3768866),
            array('ChIJRcbZaklDXz4RYlEphFBu5r0', 'Dubai - United Arab Emirates', 55.2707828, 25.2048493),
            array('ChIJufI-cg9EXj4RCBGXQZMuzMc', 'Abu Dhabi - United Arab Emirates', 54.3773438, 24.453884),
            array('ChIJmZNIDYkDLz4R1Z_nmBxNl7o', 'Riyadh Saudi Arabia', 46.6752957,  24.7135517),
            array('ChIJi3lwCZyTC0cRkEAWZg-vAAQ', 'Prague, Czechia', 14.4378005, 50.0755381),
            array('ChIJ2_UmUkxNekgRqmv-BDgUvtk', 'Manchester, UK', -2.2426305, 53.4807593),
            array('ChIJU0sSh1GK7IgR-LH91HoH7us', 'Tallahassee, FL, USA', -84.28073289999999, 30.4382559),
            array('ChIJ8cM8zdaoAWARPR27azYdlsA', 'Kyoto, Japan', 135.7681489, 35.011564),
            array('ChIJSx6SrQ9T2YARed8V_f0hOg0', 'San Diego, CA, USA', -117.1610838, 32.715738),
            array('ChIJOwg_06VPwokRYv534QaPC8g', 'New York, NY, USA', -74.0059728, 40.7127753),
            array('ChIJ7cv00DwsDogRAMDACa2m4K8', 'Chicago, IL, USA', -87.6297982, 41.8781136),
            array('ChIJ685WIFYViEgRHlHvBbiD5nE', 'Glasgow, UK', -4.251806, 55.864237),
            array('ChIJq0fR1gS8woAR0R4I_XnDx9Y', 'Beverly Hills, CA, USA', -118.4003563, 34.0736204),
        );

        $randomPlace = array_rand($places);

        return [
            'user_id' => rand(1, env('USER_SEEDER')),
            'model_id' => rand(1, 1322),
            'place_id' => $places[$randomPlace][0],
            'location' => $places[$randomPlace][1],
            'lng' => $places[$randomPlace][2],
            'lat' => $places[$randomPlace][3],
            'description' => $this->faker->paragraph,
        ];
    }

    public function configure()
    {
        $place = new PlacesApi(config('services.google_places.api_key'));

        return $this->afterCreating(function (Car $car) use ($place) {
            $placeData = (new CarService())->placeData($car->place_id, $place);
            $car->place()->createMany($placeData);
        });
    }
}
