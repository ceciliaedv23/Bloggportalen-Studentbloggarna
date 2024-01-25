<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klasser för att använda klassernas metoder
$postObject = new Postmanager;
$userObject = new Usermanager;
?>

<?php
include("includes/header.php");
?>

<!-- Introduktion till webbplatsen inklusive snabba länkar -->
<section class="section-intro grid-container-intro">
    <div class="grid-intro-1">
        <h2>Berätta mer...</h2>
        <p>Det här är bloggportalen för dig som student. Dela dina erfarenheter om tentaångest, nationsfester och vardagslivet som student.</p><br>
        <p>Sugen på att börja blogga?</p><br><a class="section-intro-button" href=register.php>Registrera dig</a><br><br>
        <p>Redan registrerad?</p><br><a class="section-intro-button" href=login.php>Logga in på Mina sidor</a>
    </div>
    <div class="grid-intro-2">
        <picture>
            <source type="image/webp" srcset="includes/images/studenterwebp.webp">
            <img src="includes/images/studenterjpg.jpg" alt="">
        </picture>
    </div>
</section>

<!-- Några blogginlägg visas -->
<section class='section'>
    <h2> Senaste blogginläggen </h2>
    <div class="post-container">
        <?php

        //Använder klassmetod
        $fiveLatestPostsList = $postObject->getFiveLatestPosts();

        //Publicering av de 5 senaste blogginläggen oavsett bloggare
        foreach ($fiveLatestPostsList as $row) {
            echo "<article>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p class='article-date'><i>Publicerad: " . $row['postdate'] . "</i></p>";
            echo "<p>Författare: <a>" . $row['authorname'] . "</a></p>";

            //Begränsning av längd, om långt inlägg så får den länk till inlägget i sin helhet
            if (strlen($row['content']) > 299) {
                echo substr("<p>" . $row['content'], 0, 300);
                echo "...</p>";
                echo "<a class='link-fortsattning' href='singlepost.php?id=" . $row['id'] . "'>Fortsättning</a><br><br><br>";
            } else {
                echo $row['content'] . "<br><br><br>";
            }
            echo "</article>";
        }
        ?>
    </div>
</section>

<!-- Bloggare visas -->
<section class="section">
    <div class="blogger-container">
        <h2> Vi som bloggar</h2>
        <p class="paragraph-structure">Klicka på namnet tillhörande den bloggare du vill se inlägg från.</p>
        <?php

        //Använder klassmetod
        $userNameList = $userObject->getUserNames();

        //Publicering av namn på alla registrerade bloggare
        foreach ($userNameList as $row) {
            echo "<div class='each-blogger'>";
            echo "<p><a href='userposts.php?allpostsby=" . $row['id'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</a></p></div>";
        }
        ?>
    </div>
</section>

<?php
include("includes/footer.php");
?>