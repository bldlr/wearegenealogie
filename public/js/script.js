const cards = document.querySelectorAll(".row-enfant-genealogie .cards-genealogie");
const trait = document.querySelector(".trait-relation");
const bodyPopUp = document.querySelector(".bodyPopUp");
const popUp = document.querySelector(".popUp");
let traitWidth = 0;

/* boucler sur chaque card enfant pour calculer sa width, puis rajouter cette width au trait */

cards.forEach((card, index) => {

    if (index == 0 || index == cards.length - 1) {
        traitWidth += (card.offsetWidth / 2) + 20;
    }
    else {
        traitWidth += card.offsetWidth + 40;
    }

});

trait.style.width = (traitWidth + 1) + "px";

function clicCard(event) {
    bodyPopUp.style.display = "block";
    popUp.innerHTML = event.target.innerHTML;
}

function fermerPopUp(event) {
    if (event.target.classList == "popUp") {
        event.stopPropagation();
    }
    else {
        bodyPopUp.style.display = "none";
    }
}