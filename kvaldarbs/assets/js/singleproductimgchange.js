var mainPhoto = document.getElementById("mainPhoto");
var secondaryPhoto = document.getElementsByClassName("secondary-photo");
for(let i=0; i<4; i++) {
    secondaryPhoto[i].onclick = function() {
        mainPhoto.src = secondaryPhoto[i].src;
    }
}