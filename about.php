<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/header.php");
?>

<section class="section about">
    <h2>Om oss</h2>
    <p>Denna bloggportal är fiktiv och skapad som ett projektarbete i kursen Webbutveckling II.
        Kursen går igenom objektorienterad användning av programmeringsspråket PHP och databasanslutningnar
        i syfte att skapa dynamiska webbplatser samt versionshantering med Git. <br><br>

        Webbplatsen "Studentbloggarna" erbjuder ett flertal dynamiska funktionaliteter. Man kan registrera sig som
        bloggare, logga in på "Mina sidor" och där skriva/uppdatera/radera sina inlägg. Det är dessutom möjligt
        att radera sitt användarkonto och med det även alla sina blogginlägg. Webbplatsen tillåter alla besökare
        att läsa inlägg av de bloggare som finns registrerade. För registrering, inloggning och hantering av
        blogginlägg tas hänsyn till säkerhetsrisker för att skadlig data inte ska kunna komma åt databasen. <br><br>

        För uppbyggnad av webbplatsen har språken HTML, CSS, JavaScript och PHP samt en databas av MySQL-typ använts.
        Filerna har versionhanteras med Git.

        Jag som skapare av webbplatsen heter Cecilia Edvardsson och är student på Webbutvecklingsprogrammet på Mittuniversitetet. Besök gärna <a href="https://ceciliaedv.netlify.app/" target="_blank" style="color:black; text-decoration:underline">min webbplats</a>.</p>
</section>

<?php
include("includes/footer.php");
?>