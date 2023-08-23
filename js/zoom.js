function showBigImage(src) {
  var modal = document.getElementById("myModal");
  var modalImg = document.getElementById("zoomedImg");
  modal.style.display = "block";
  modalImg.src = src;
}

function closeModal() {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}