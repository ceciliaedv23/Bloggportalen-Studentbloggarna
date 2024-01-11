<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klass för att använda klassens metoder
$postObject = new Postmanager();
?>

<?php
//Användaren skickas tillbaka till startsidan om id för ett blogginlägg saknas
if (!isset($_GET['id'])) {
    header("Location: index.php");
}
?>

<?php
include("includes/header.php");
?>

<section class="section singleposts">
    <h2>Blogginlägg i sin helhet</h2>
    <br>
    <div class="singlepost-container">
        <?php
        $postID = intval($_GET['id']);

        //Aktuellt blogginlägg hämtas
        $result = $postObject->getOneUserPost($postID);

        //Publicering av inlägg
        foreach ($result as $row) {
            echo "<article>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<p>Bloggare: <a>" . $row['authorname'] . "</a></p>";
            echo "<p class='article-date'>Publicerad: " . $row['postdate'] . "</p>";
            echo "</article>";
        }
        ?>
    </div>
    <br>
    <a class="link-tillbaka" href="index.php"><i class="fa-solid fa-arrow-left" style="color: #193e1d; margin-right:10px;"></i>Tillbaka till startsidan</a>
</section>

<?php
include("includes/footer.php");
?>