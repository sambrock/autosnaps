if(document.querySelector('.custom-select-container')) document.querySelector('.custom-select-container').addEventListener('click', function () {
  this.querySelector('.custom-select').classList.toggle('open');
});

if(document.querySelector('.custom-select-container')) document.querySelector('.custom-select-container').addEventListener('keyup', function () {
  this.querySelector('.custom-select').classList.add('open');
});

export const attachEventListeners = () => {

  for (const option of document.querySelectorAll(".custom-option.location-option")) {
    option.addEventListener('click', function () {
      const locationInput = document.getElementById('location');
      const placeIdInput = document.getElementById('placeId');

      locationInput.value = this.textContent;
      placeIdInput.value = this.getAttribute('data-place-id');
    })
  }

  for (const option of document.querySelectorAll(".custom-option.search-option")) {
    option.addEventListener('click', function () {
      const searchSelect = document.getElementById('searchSelect');
      const searchInput = document.getElementById('searchOption');
      
      searchSelect.innerText = this.textContent;
      searchInput.value = this.getAttribute('data-search-option');
    })
  }
}

if(document.querySelector('.custom-select-container')) attachEventListeners();
