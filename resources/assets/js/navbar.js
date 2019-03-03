//Scroll small navbar
const navbar = document.getElementsByClassName("navbar-custom")[0];
const navbutton = document.getElementsByClassName("navbar-toggler")[0];

navbutton.classList.add("collapsed");

navbar.addEventListener("touchmove",e => {
    e.preventDefault();
});

window.onscroll = () => {

    if (window.pageYOffset > 50) {
        navbar.classList.add("scrolled");
    }

    if (window.pageYOffset == 0) {
        navbar.classList.remove("scrolled");
    }

    if (!(navbutton.classList.contains("collapsed"))){
        navbutton.click();
    }

};
