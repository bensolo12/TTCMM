const input = document.getElementById("newImage");

input.addEventListener("change", function() {
  const file = input.files[0];
  const reader = new FileReader();

  reader.addEventListener("load", function() {
    const image = new Image();
    image.src = reader.result;
    document.body.appendChild(image);
  });

  reader.readAsDataURL(file);
});