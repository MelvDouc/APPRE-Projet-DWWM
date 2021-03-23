window.addEventListener("DOMContentLoaded", () => {

// Variables

    const navIcon = document.querySelector("nav i"),
        navList = document.querySelector("nav ul"),
        main = document.querySelector("main"),
        header = document.querySelector("header"),
        footer = document.querySelector("footer"),
        carousel = document.getElementById("carousel"),
        singlePageContainers = document.getElementsByClassName("hauteur-100"),
        usernameRegex = /^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/,
        birthdateRegex = /^(19|20)\d\d\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/;

    const randomInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;
    const getPropValue = (elem, prop) => parseFloat(getComputedStyle(elem).getPropertyValue(prop));

// ====================
// Set main height
// ====================

    const setMainHeight = () => {
        const mainHeight = window.innerHeight - getPropValue(header, "height") - getPropValue(footer, "height");
        main.style.minHeight = mainHeight + "px";
    }

    const setSinglePageHeight = () => {
        if(singlePageContainers.length > 0) {
            Object.values(singlePageContainers).forEach(elem => {
                elem.style.height = main.style.minHeight;
            });
        }
    }

// ====================
// Header nav
// ====================

    function displayNavMenu() {
        switch (navIcon.className) {
            case "bi bi-list":
                navIcon.className = "bi bi-x-circle";
                break;
            case "bi bi-x-circle":
                navIcon.className = "bi bi-list";
                break;
        }
        let navListDisplayVal = getComputedStyle(navList).getPropertyValue("display");
        navList.style.display = (navListDisplayVal === "none") ? "block" : "none";
    }

    navIcon.addEventListener("click", displayNavMenu);

// ====================
// Carousel
// ====================

// function defilerCarousel() {
//     let carouselImages = document.querySelectorAll("#carousel img");
//     carousel.insertAdjacentElement("beforeend", carouselImages[0]);
// }

// setInterval(defilerCarousel, 5000);

// ====================
//
// ====================

    const checkUpdateProfileForm = () => {
        const usernameInput = document.getElementById("pseudo"),
        birthdateInput = document.getElementById("date_de_naissance"),
        zipCodeInput = document.getElementById("code_postal"),
        submitButton = document.querySelector("button[type='submit']");
        
        if([usernameInput, birthdateInput, zipCodeInput, submitButton].every(elem => elem != null)) {
            submitButton.addEventListener("click", (e) => {
                if (usernameInput.value != "" && !usernameRegex.test(usernameInput)) {
                    e.preventDefault();
                    usernameInput.style.outline = "2px solid red";
                } else if(birthdateInput.value != "" && !birthdateRegex.test(birthdateInput.value)) {
                    e.preventDefault();
                    birthdateInput.style.outline = "2px solid red";
                } else if(zipCodeInput.value != "" && isNaN(zipCodeInput.value)) {
                    e.preventDefault();
                    zipCodeInput.style.outline = "2px solid red";
                }
            });
            for(let input of [usernameInput, birthdateInput, zipCodeInput]) {
                input.addEventListener("click", function() {
                    this.removeAttribute("style");
                })
            }
        }
    }


    setMainHeight();
    setSinglePageHeight();
    checkUpdateProfileForm();

});