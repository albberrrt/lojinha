const closeButton = document.getElementById("closeAlertButton");
const errorSec = document.getElementById("errorSecId");
const errorDiv = document.getElementById("errorDiv");

closeButton.addEventListener("click", function () {
  errorSec.classList.remove("errorSection");
  errorDiv.classList.remove("errorAlert");
  errorSec.classList.add("errorAlertDesactive");
  errorDiv.classList.add("errorAlertDesactive");
});
