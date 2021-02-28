import countries from 'i18n-iso-countries';
import { getPlaces } from './api';
import { attachEventListeners } from './customDropdown';

countries.registerLocale(require("i18n-iso-countries/langs/en.json"));

const locationInput = document.getElementById('location');

const debounce = (callback, wait) => {
  let timeout;
  return (...args) => {
    clearTimeout(timeout);
    timeout = setTimeout(() => { callback.apply(this, args) }, wait);
  };
}

const displayPredictions = async () => {
  const { predictions } = await getPlaces(locationInput.value);
  if(!predictions) return;

  const predictionsDiv = document.getElementById('predictions');
  predictionsDiv.innerHTML = "";

  let options = '';
  predictions.forEach(prediction => options += `<div class="custom-option location-option p-4" data-place-id="${prediction.place_id}"><img src="https://purecatamphetamine.github.io/country-flag-icons/3x2/${countries.getAlpha2Code(prediction.terms.pop().value, 'en')}.svg" />${prediction.description}</div>`);
  predictionsDiv.insertAdjacentHTML('beforeend', options);

  attachEventListeners();
}

if (document.getElementById('location')) locationInput.addEventListener('keyup', debounce(() => {
  if(locationInput.value) displayPredictions();
}, 300));