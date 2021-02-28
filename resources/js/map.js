import { getMarkers } from "./api";

const markerEl = (location) => {
  const el = document.createElement('div');

  el.className = 'marker';
  el.id = location.place_id;
  el.innerHTML = `<div class="dot"><div class="marker-txt">
  <span class="location">${location.location}</span>
  <span class="count"><i class="material-icons mr-1">camera_alt</i>${location.count} cars</span>
  </div></div>`;

  return el;
}

const mapMarkers = async () => {
  const markers = await getMarkers();
  console.log(Object.values(markers));

  Object.values(markers).forEach(location => {
    const marker = new mapboxgl.Marker(markerEl(location)).setLngLat([location.lng, location.lat]).addTo(map);

    const markerDiv = marker.getElement();
    markerDiv.addEventListener('click', () => window.location.href = `/cars/location/${location.place_id}`);
  })
}

const topLocations = async () => {
  const response = await getMarkers();
  const locations = Object.values(response);

  const locationsDiv = document.getElementById('locations');
  locationsDiv.innerHTML = "";

  let list = '';
  locations.forEach((location, index) => {
    list += `<div class="location-btn flex flex-shrink-0 cursor-pointer select-none" style="flex-shrink: 0;" data-place-id="${location.place_id}" data-lng="${location.lng}" data-lat="${location.lat}">
    <div class="mr-1 text-primary text-base font-bold">${index + 1}</div>  
    <div>
      <div class="text-white font-bold text-xs sm:text-xl">${location.location}</div>
      <div class="text-opacity flex items-center font-semibold text-xs sm:text-base"><i class="material-icons mr-1">camera_alt</i>${location.count} cars</div></div>
    </div>
    </div>`;
  });

  locationsDiv.insertAdjacentHTML('beforeend', list);
  locationEventListeners();
}

const locationEventListeners = () => {
  for (const option of document.querySelectorAll(".location-btn")) {

    option.addEventListener('click', function () {
      map.flyTo({ center: [option.getAttribute('data-lng'), option.getAttribute('data-lat')-.2], essential: true, zoom: 8 });

      document.querySelectorAll('.marker').forEach(el => el.classList.remove('active')); // Close markers
      document.getElementById(option.getAttribute('data-place-id')).classList.add('active'); // Open clicked marker
    })
  }
}

if (document.getElementById('map')) mapMarkers();
if (document.getElementById('map')) topLocations();
