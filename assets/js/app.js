/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

const $ = require("jquery")
require("bootstrap")

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

var mesElements = document.querySelectorAll("li.nav-item");
mesElements.forEach(function(element){
    element.addEventListener("mouseenter", function(event){
        element.style.backgroundColor = "green";
    }, false);

    element.addEventListener("mouseleave", function(event){
        element.style.backgroundColor = "#343a40";
    }, false);

});


//Animer le nom des continents pages continents & le nom des recettes

var textWrapper = document.querySelector('.ml16');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml16 .letter',
    translateY: [-100,0],
    easing: "easeOutExpo",
    duration: 1400,
    delay: (el, i) => 30 * i
  }).add({
    targets: '.ml16',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
