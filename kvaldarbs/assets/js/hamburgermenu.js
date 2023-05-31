let navbar = document.getElementById("ul-links");
let hamburgerIcon = document.getElementById("hamburger-menu");
let naviglinks = document.querySelectorAll("fa-times");
hamburgerIcon.addEventListener("click", () => {
    navbar.classList.toggle("active");
    hamburgerIcon.classList.toggle("fa-times");
});
naviglinks.forEach((naviglinks) => {
    naviglinks.addEventListener("click", () => {
        navbar.classList.remove("active");
        hamburgerIcon.classList.toggle("fa-times");
    });
})