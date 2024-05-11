function openPopup(imageSrc) {
    document.getElementById("imagePopup").style.display = "block";
    document.querySelector(".popup-image").src = imageSrc;
}

function closePopup() {
    document.getElementById("imagePopup").style.display = "none";
}
