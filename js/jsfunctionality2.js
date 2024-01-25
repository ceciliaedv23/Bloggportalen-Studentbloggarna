/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */

"use strict";

/* Räkna tecken i textfält */

let textarea = document.getElementById("new-post-content");
let currentCharactersCounter = document.getElementById("currentCharactersCounter");
let skrivMer = document.getElementById("skriv-mer");

textarea.addEventListener("keyup", characterCounter, false);

let maxlimitCharacters = 700;

/* Funktionen läser in antal tecken när fältet används, presenterar antal tecken och ändrar färg beroende på antal tecken */
function characterCounter() {
    let currentCharactersAmount = textarea.value.length;
    if (currentCharactersAmount > maxlimitCharacters) {
        return false;
    }
    currentCharactersCounter.textContent = "Antal använda tecken: " + currentCharactersAmount;

    if(currentCharactersAmount<50) {
        skrivMer.style.color="red";
        skrivMer.innerHTML = " Skriv mer!";
    } else {
        skrivMer.style.color="green";
        skrivMer.innerHTML = " Lagom!";
    }
}