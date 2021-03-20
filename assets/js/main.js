// import {BookCard} from './classes/BookCard.js';

// Variables

const iconeNavigation = document.querySelector("nav i"),
    listeNavigation = document.querySelector("nav ul"),
    carousel = document.getElementById("carousel");

const randomInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

// ====================
// Header nav
// ====================

function afficherMenuNavigation() {
    switch (iconeNavigation.className) {
        case "bi bi-list":
            iconeNavigation.className = "bi bi-x-circle";
            break;
        case "bi bi-x-circle":
            iconeNavigation.className = "bi bi-list";
            break;
    }
    let listeNavigationDisplayVal = getComputedStyle(listeNavigation).getPropertyValue("display");
    listeNavigation.style.display = (listeNavigationDisplayVal === "none") ? "block" : "none";
}

iconeNavigation.addEventListener("click", afficherMenuNavigation);

// ====================
// Carousel
// ====================

// let index = -1;
// function defilerCarousel() {
//     index = ++index % carouselImages.length; // 0 1 2 3 4, 0 1 2...
//     carousel.insertAdjacentElement("beforeend", carouselImages[index]);
// }

function defilerCarousel() {
    let carouselImages = document.querySelectorAll("#carousel img");
    carousel.insertAdjacentElement("beforeend", carouselImages[0]);
}

// setInterval(defilerCarousel, 5000);

// ====================
// 
// ====================