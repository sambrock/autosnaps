const dropzone = document.querySelector('.dropzone__prompt');
const imageInput = document.getElementById('image');
const countSpan = document.getElementById('imageCount');

let activeCol = 0;
const fileTypes = ['image/jpeg', 'image/png', 'image/webp'];

const attachEventListeners = () => {
  dropzone.addEventListener('dragover', e => {
    e.preventDefault();
  
    dropzone.classList.add('dropzone--over');
  });
  
  ['dragleave', 'dragend'].forEach(event => dropzone.addEventListener(event, e => dropzone.classList.remove('dropzone--over')));
  
  dropzone.addEventListener('drop', e => {
    e.preventDefault();
    addImages(e.dataTransfer.files);
    document.getElementById('images').value = 'yes';
    dropzone.classList.remove('dropzone--over');
  });
  
  imageInput.onchange = (e) => {
    e.preventDefault();
    addImages(e.target.files);
    document.getElementById('images').value = 'yes';
    dropzone.classList.remove('dropzone--over');
  };
}

if(dropzone) attachEventListeners();

const addImages = (files) => {
  const filesAccepted = [];

  [...files].forEach(file => filesAccepted.push(isFileImage(file)));

  if (filesAccepted.indexOf(true)) return alert('This file is not an image.');

  if (files.length) {
    imageInput.files = files;
    countSpan.textContent = `${imageInput.files.length} images`;
  document.querySelectorAll('.dropzone__col').forEach(col => col.innerHTML = "");
    updateThumbnails([...files]);
    activeCol = 0;
  }
}

function read(file, callback) {
  const reader = new FileReader();

  reader.readAsDataURL(file);
  reader.onload = function () {
    callback(reader.result);
  }
}

const thumbnail = (result, file) => `<div class="thumbnail"><img src="${result}" />${file.name}</div>`;

const updateThumbnails = (files) => {
  const thumbnailCols = document.querySelectorAll('.dropzone__col');

  files.forEach(file => read(file, (result) => {
    if (activeCol === 3) activeCol = 0;
    thumbnailCols[activeCol].insertAdjacentHTML('beforeend', thumbnail(result, file));
    activeCol++;
  }));
}

const isFileImage = (file) => {
  const acceptedImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

  return file && acceptedImageTypes.includes(file['type'])
}