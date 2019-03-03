//Scroll small navbar

window.onscroll = navipadding => {
    const navbar = document.getElementsByClassName("navbar-custom")[0];

    if (window.pageYOffset > 50) {
        navbar.classList.add("scrolled");
    }

    if (window.pageYOffset == 0) {
        navbar.classList.remove("scrolled");
    }

}