'use strict';
//Gestion du blob en background
const blob = document.getElementById("blob");

document.body.onpointermove = event => {
    const { clientX, clientY } = event;

    blob.animate({
        left: `${clientX}px`,
        top: `${clientY}px`
    }, { duration: 3000, fill: "forwards" });
}



//Gestion de l'actualistion du form lors de l'abonnement 
var form = document.getElementById("formId");
var opTag = document.getElementById("opTag");

function submitForm(event) {
    event.preventDefault();
    form.style.display = "none";
    opTag.innerHTML = "<b>Bienvenue chez nous !!!!!</b>";
}
form.addEventListener('submit', submitForm);




// Initialize Variables
var closePopup = document.getElementById("popupclose");
var overlay = document.getElementById("overlay");
var popup = document.getElementById("popup");
var button = document.getElementById("button");
// Close Popup Event
closePopup.onclick = function() {
    overlay.style.display = 'none';
    popup.style.display = 'none';
};
// Show Overlay and Popup
button.onclick = function() {
    overlay.style.display = 'block';
    popup.style.display = 'block';
}
