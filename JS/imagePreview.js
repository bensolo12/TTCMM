const input = document.getElementById('image-upload');
const namePreview = document.getElementById('name-preview');
const imagePreview = document.getElementById('image-preview');

input.addEventListener('change', () => {
    namePreview.innerHTML = '';
    imagePreview.innerHTML = '';

    for (let i = 0; i < 6; i++) {
        const file = input.files[i];
        if (file) {
            const fileName = file.name;
            const nameElement = document.createElement('p');
            const img = document.createElement('img');

            nameElement.textContent = fileName;
            namePreview.appendChild(nameElement);

            img.src = URL.createObjectURL(file);
            img.onload = () => URL.revokeObjectURL(img.src);
            imagePreview.appendChild(img);
        }
    }
});