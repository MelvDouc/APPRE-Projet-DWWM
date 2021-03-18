// import {BookCard} from './classes/BookCard.js';

// Variables

const navIcon = document.querySelector("nav i"),
    navList = document.querySelector("nav ul"),
    carousel = document.getElementById("carousel");

const randomInt = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

// ====================
// Header nav
// ====================

function displayNavMenu() {
    switch (navIcon.className) {
        case "fas fa-bars":
            navIcon.className = "fas fa-times";
            break;
        case "fas fa-times":
            navIcon.className = "fas fa-bars";
            break;
    }
    let navListDisplayVal = getComputedStyle(navList).getPropertyValue("display");
    navList.style.display = (navListDisplayVal === "none") ? "initial" : "none";
}

navIcon.addEventListener("click", displayNavMenu);

// ====================
// Carousel
// ====================

// let index = -1;
// function slideThrough() {
//     index = ++index % carouselImages.length; // 0 1 2 3 4, 0 1 2...
//     carousel.insertAdjacentElement("beforeend", carouselImages[index]);
// }

function slideThrough() {
    let carouselImages = document.querySelectorAll("#carousel img");
    carousel.insertAdjacentElement("beforeend", carouselImages[0]);
}

// setInterval(slideThrough, 5000);

// ====================
// 
// ====================