<div class="flex flex-col">
  <label for="make" class="block font-semibold mb-4">{{ __('Make') }}:</label>
  <select id="make" class="form-input" name="make" autocomplete="make" required>
    @foreach ($makes as $make)
    @if (old('make') == $make->id || (isset($car) ? $car->carModel->make_id == $make->id : ''))
    <option value="{{ $make->id }}" selected>{{$make->name}}</option>
    @else
    <option value="{{$make->id}}">{{$make->name}}</option>
    @endif
    @endforeach
  </select>
</div>
<div class="flex flex-col">
  <label for="model_id" class="block font-semibold mb-4">{{ __('Model') }}:</label>
  <select id="model" class="form-input @error('model_id')  border-red-500 @enderror" name="model_id" autocomplete="model_id" required></select>
  @error('model_id')
  <p class="text-primary text-xs italic mt-4">{{ $errors->first('model_id') }} </p>
  @enderror
</div>
<div class="flex flex-col">
  <label for="location" class="block font-semibold mb-4">{{ __('Location') }}:</label>
  <div class="custom-select-container" style="width: calc(100% + 3px);">
    <div class="custom-select" style="border: 1px solid var(--dark-grey)">
      <div class="custom-select__trigger">
        <div class="arrow" style="font-size: 1.8em; padding: 7px 12px 0;"><i class="material-icons">search</i></div>
        <input id="location" type="text" class="form-input custom-select-input @error('location') border-red-500 @enderror" value="{{ old('location') ?? $car->location ?? ''}}" name="location" autocomplete="location" required />
      </div>
      <div class="custom-options" id="predictions"></div>
    </div>
  </div>
  @error('location')
  <p class="text-primary text-xs italic mt-4">{{ $errors->first('location') }} </p>
  @enderror
</div>
<div class="flex flex-col row-span-4">
  <label for="image_url" class="block font-semibold mb-4">{{ __('Image(s)') }}:</label>
  {{-- <input id="image_url" type="text" class="form-input @error('image_url') border-red-500 @enderror" name="image_url" value="{{ old('image_url') ?? $car->image_url ?? '' }}" autocomplete="image_url" required /> --}}
  <div class="dropzone">
    <div class="dropzone__prompt">
      <i class="material-icons">cloud_upload</i>
      <span>Drag and drop images</span>
      <span>or</span>
      <label class="browse" for="image">Browse</label>
    </div>
    <div class="dropzone__info"><span onclick="removeImages()" class="btn">Remove</span><span id="imageCount"></span></div>
    <div class="dropzone__thumbnails" id="thumbnails">
      <div class="dropzone__col"></div>
      <div class="dropzone__col"></div>
      <div class="dropzone__col"></div>
    </div>
    <input type="file" name="image[]" id="image" class="dropzone__input" multiple>
  </div>
  @error('images')
  <p class="text-primary text-xs italic mt-4">{{ $errors->first('images') }} </p>
  @enderror
</div>
<div class="flex flex-col">
  <label for="description" class="block font-semibold mb-4">{{ __('Description') }}:</label>
  <textarea id="description" name="description" rows="4" class="form-input @error('description') border-red-500 @enderror" name="description">{{ old('description') ?? $car->description ?? ''}}</textarea>
  @error('description')
  <p class="text-primary text-xs italic mt-4">{{ $errors->first('description') }} </p>
  @enderror
</div>

<!-- Hidden inputs -->
<input id="placeId" class="hidden" name="place_id" value="{{ old('place_id') ?? $car->place_id ?? '' }}">
<input id="images" class="hidden" name="images" value="no">

<script>
  const allModels = {!! json_encode($models->toArray()) !!};
  const makeSelect = document.getElementById('make');

  const modelSelect = document.getElementById('model');

  const getModelOptions = (make) => {
    let optionModels;
    optionModels = allModels.filter(m => m.make_id === make);

    modelSelect.innerHTML = '';
    
    return optionModels.forEach(option => modelSelect.add( new Option(option.name, option.id)));
  }
  
  const getSelectedModel = (model) => {
    for (let option of modelSelect.options) {
      if(parseInt(option.value) === model) option.setAttribute('selected', true);
    }
  }
  
  makeSelect.addEventListener('change', () => getModelOptions(makeSelect.selectedIndex + 1));
  
  getModelOptions(makeSelect.selectedIndex + 1);
</script>

<script>
  const removeImages = () => {
    document.getElementById('image').value = "";
    document.querySelectorAll('.dropzone__col').forEach(col => col.innerHTML = "");
    document.getElementById('imageCount').textContent = '';
  }
</script>

@if(isset($car))
<script>
  const model = {!! json_encode($car->model_id) !!}

  getSelectedModel(model);

  document.getElementById('images').value = 'yes';
</script>
@endif
