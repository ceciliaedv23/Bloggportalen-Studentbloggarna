/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */

"use strict";

/* Hamburgermeny */

let menuIcon = document.getElementById("menu-icon");

menuIcon.addEventListener("click", toggleMenu, false);

// Öppna och stäng varje kurs
function toggleMenu() {
  let navigationList = document.getElementById("navlist");

  // CSS kopplas in
  let style = window.getComputedStyle(navigationList);

  // Öppna om den tidigare var stängd, respektive motsatsen
  if (style.display === "none") {
    navigationList.style.display = "block";
  } else {
    navigationList.style.display = "none";
  }
}

/* Användarvillkor vid registrering */

let termsconds = document.getElementById("userconditions");
termsconds.addEventListener("click", showconditions, false);

/* Funktionen öppnar fönster med skrivna användarvillkor */
function showconditions() {
  let fulltext =
    "Härmed beskrivs de användarvillkor som gäller vid användning av bloggportalen Studentbloggarna. Plattformen erbjuder privatpersoner att skapa en blogg, publicera blogginlägg och läsa andras bloggar.<br> För att skapa en blogg registrerar du ett medlemskap, och godkänner våra användarvillkor i samband med denna registrering. Medlemskap är kostnadsfritt.<br><br> Som medlem får du tillgång till en egen blogg och tillhörande bloggverktyg på bloggportalen Studentbloggarna. Detta medlemskap är personligt. Det är inte tillåtet att använda sig av andra medlemmars användarkonton och bloggar. Du är förpliktigad att vara försiktig med ditt lösenord och förvara det på ett säkert sätt. Om någon obehörig får tillgång till dina användaruppgifter ska du höra av dig till Studentbloggarna för att få hjälp.<br><br> Du ansvarar för det innehåll som du publicerar genom dina blogginlägg. Materialet får inte uppmana till eller utgöra brottslig handling, kränka, hota eller förtala människor, sprida skadlig kod eller strida mot tystnadsplikt. Studentbloggarna har rätt att ta bort och eventuellt polisanmäla publicerat material som strider mot ovanstående.<br><br> Vissa av dina uppgifter lagras och behandlas av Studentbloggarna i syftet att administrera och överse din användning av bloggportalen. Du har rätt att begära ut dessa uppgifter och gör isåfall detta via e-post till info@studentbloggarna.se. Uppgifterna består av e-postadress, namn och användarnamn. Vi lagrar och behandlar även uppgifter kring ditt surfbeteende, vilket kan gälla cookies eller IP-adresser. Cookies används för att göra ditt användande av portalen enklare och effektivare, medan IP-adress sparas för eventuella rättsärenden.";

  let termsconWindow = window.open("", "msgWindow", "width=400,height=700");
  termsconWindow.document.write("<p>" + fulltext + "</p>");
}
