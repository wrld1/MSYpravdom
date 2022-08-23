let imgs = document.querySelectorAll(".about-us__img");
let popup = document.querySelector(".popup-image");

imgs.forEach((image) => {
  function openImage() {
    popup.style.display = "block";
    document.querySelector(".popup-image img").src = image.getAttribute("src");
    document.body.style.overflow = "hidden";
  }
  image.addEventListener("click", openImage);

  function closeImage() {
    popup.style.display = "none";
    document.body.style.overflow = "auto";
  }

  document.querySelector(".popup-image span").addEventListener("click", closeImage);

  document.addEventListener("keydown", (e) => {
    if (e.code === "Escape") {
      closeImage();
    }
  });

  popup.addEventListener("click", (e) => {
    if (e.target === popup) {
      closeImage();
    }
  });
});
