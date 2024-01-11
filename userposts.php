<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klass för att använda klassens metoder
$postObject = new Postmanager;

//Om inget id skickas med länken så skickas användaren tillbaka till startsidan
if (isset($_GET['allpostsby'])) {
    $id = intval($_GET['allpostsby']);

    //Bloggarens fulla namn tas fram genom klassmetod inför senare publicering
    $userFullName = $postObject->getUserFullName($id);

    //Bloggarens email tas fram genom klassmetod för att identifiera bloggaren i posts-tabellen
    $userEmail = $postObject->getUserEmail($id);

    //Bloggarens inlägg hämtas genom klassmetod och sparas i lista 
    $userBlogPosts = $postObject->getUserPosts($userEmail);
} else {
    header("location:index.php");
}

?>
<?php
include("includes/header.php");
?>

<section class="section section-userposts">
    <?php
    echo "<h2> Alla blogginlägg av " . $userFullName . "</h2>";
    ?>
    <div class="post-container">

        <?php
        //Om bloggaren har skrivit inlägg så ska de publiceras, annars kommer meddelande om att det inte finns några
        if ($userBlogPosts) {

            //Publicering av inlägg
            foreach ($userBlogPosts as $row) {
                echo "<article>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>" . $row['content'] . "</p>";
                echo "<p>Bloggare: <a>" . $row['authorname'] . "</a></p>";
                echo "<p class='article-date'><i>Publicerad: " . $row['postdate'] . "</i></p>";
                echo "</article>";
            }
        } else {
            echo "<p class='paragraph-structure'>Denna bloggare har ännu inte skrivit något blogginlägg.</p>";
        }
        ?>
    </div>
    <br>
    <a class="link-tillbaka" href="index.php"><i class="fa-solid fa-arrow-left" style="color: #193e1d; margin-right:10px;"></i>Tillbaka till startsidan</a>
</section>

<?php
include("includes/footer.php");
?>