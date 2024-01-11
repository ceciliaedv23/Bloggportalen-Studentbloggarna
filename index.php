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
<div class="intro-page">
    <section class="section-intro">
        <div class="opening">
            <h2>Berätta mer...</h2>
            <p>Det här är bloggportalen för dig som student. Dela dina erfarenheter om tentaångest, nationsfester och vardagsliv som student.</p><br>
        </div>
        <div class="intro-links">
            <div>
                <p class="intro-links-paragraph">Sugen på att börja blogga?</p><br><a class="intro-link-button" href="register.php">Registrera dig</a><br><br>
            </div>
            <div>
                <p class="intro-links-paragraph">Redan registrerad?</p><br><a class="intro-link-button" href="login.php">Logga in</a>
            </div>
        </div>
        <picture>
            <source type="image/webp" srcset="includes/images/studenterwebp.webp">
            <img src="includes/images/studenterjpg.jpg" alt="">
        </picture>
    </section>

    <!-- Några blogginlägg visas -->
    <section class='section'>
        <h2> Senaste blogginläggen </h2>
        <div class="post-container">
            <?php

            //Använder klassmetod
            $latestPostsList = $postObject->getLatestPosts();

            //Publicering av de 5 senaste blogginläggen oavsett bloggare
            foreach ($latestPostsList as $row) {
                echo "<article>";
                echo "<h3>" . $row['title'] . "</h3><br>";
                //Begränsning av längd, om långt inlägg så får den länk till inlägget i sin helhet
                if (strlen($row['content']) > 299) {
                    echo substr("<p class='updated-p'>" . $row['content'], 0, 300);
                    echo "...<a class='link-fortsattning' href='singlepost.php?id=" . $row['id'] . "'>Fortsättning</a><br></p>";
                } else {
                    echo "<p class='updated-p'>" . $row['content'] . "</p><br>";
                }
                echo "<p>Bloggare: " . $row['authorname'] . "<br><span class='article-date'>Publicerat:" . $row['postdate'] . "</span></p>";
                echo "</article>";
            }
            ?>
        </div>
        <br>
        <picture>
            <source type="image/webp" srcset="includes/images/student3webp.webp">
            <img src="includes/images/student3jpg.jpg" alt="">
        </picture>
    </section>


    <!-- Bloggare visas -->
    <section class="section">
        <div class="blogger-container">
            <h2> Några bloggare</h2>
            <div>
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
        </div>
    </section>
</div>

<?php
include("includes/footer.php");
?>