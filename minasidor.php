<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klasser för att använda klassernas metoder
$postObject = new Postmanager();
$userObject = new Usermanager();

//Användarens email och fullständiga namn tas fram genom sessionsvariabler för att köra funktioner med
$userEmail = $_SESSION['email'];
$userFullName = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
?>

<?php
//Om en användare är inloggad så ska det inte gå att komma in på Mina sidor
if (!$_SESSION['loggedin']) {
    $_SESSION['loginrequired'] = true;
    header("location:login.php");
}
?>

<?php
//Radering av blogginlägg
if (isset($_GET['delete'])) {
    $postID = intval($_GET['delete']);

    if ($postObject->checkCorrectUser($postID, $userEmail)) {
        $postObject->deletePost($postID);
    } else {
        header("Location: index.php");
    }
}
?>

<?php
include("includes/header.php");
?>

<section class="section minasidor">
    <?php
    echo "<h2> Välkommen till din egen bloggsida, " . $_SESSION['firstname'] . "!</h2>";
    ?>
    <!-- Länk för utloggning -->
    <div class="minasidor-container">
        <a class='logout-button' href='logout.php'>Logga ut</a>
        <?php
        //Om formuläret fyllts i och skickats in kontrolleras värden och lagras om godkända, annars kommer felmeddelanden
        if (isset($_POST['new-post-title'])) {

            $newTitle = $_POST['new-post-title'];
            $newContent = $_POST['new-post-content'];

            $success = true;

            if (!$postObject->setTitle($newTitle)) {
                $success = false;
            } else {
                $title = $postObject->getTitle();
            }

            if (!$postObject->setContent($newContent)) {
                $success = false;
            } else {
                $content = $postObject->getContent();
            }

            //Om alla värden godkänns så lagras inlägget
            if ($success) {
                if ($postObject->addNewPost($userEmail, $userFullName)) {
                    $title = "";
                    $content = "";
                    //echo "<p class='successmessage bigmessage'>Blogginlägget är nu lagrat.</p>";
                    echo '<script>alert("Blogginlägget är nu lagrat.")</script>';
                } else {
                    //echo "<p class='bigmessage errormessage'>Lagringen misslyckades. Vänligen kontakta webbadministratören.</p>";
                    echo '<script>alert("Lagringen misslyckades. Vänligen kontakta webbadministratören.")</script>';
                }
            } else {
                echo "<p class='errormessage bigmessage message'>Lagringen misslyckades.<br> Vänligen kontrollera nedanstående uppgifter:</p>";
            }
        }
        ?>

        <?php
        //Utskrift av eventuella felmeddelanden gällande titel och innehåll av nytt blogginlägg
        if (isset($_SESSION['titlemissing'])) {

            echo "<p class='errormessage'>- Titeln måste innehålla minst 3 och högst 60 tecken varav dessa består av minst 1 liten bokstav.</p>";
        }
        unset($_SESSION['titlemissing']);

        if (isset($_SESSION['contentmissing'])) {
            echo "<p class='errormessage'>- Innehållet måste bestå av minst 50 och högst 700 tecken.</p>";
        }
        unset($_SESSION['contentmissing']);
        ?>

        <?php
        //Utskrift av meddelanden om raderade/uppdaterade blogginlägg
        if (isset($_GET['posterased'])) {
            //echo "<p class='successmessage bigmessage'>Blogginlägget är nu raderat.</p>";
            echo '<script>alert("Blogginlägget är nu raderat.")</script>';
        }
        unset($_SESSION['posterased']);

        if (isset($_SESSION['postupdated'])) {
            //echo "<p class='successmessage bigmessage'>Blogginlägget är nu uppdaterat.</p>";
            echo '<script>alert("Blogginlägget är nu uppdaterat.")</script>';
        }
        unset($_SESSION['postupdated']);
        ?>
        <div class="newpost-container">
            <h3>Skriv nytt blogginlägg</h3>

            <!-- Formulär för nytt blogginlägg -->
            <form method=POST action="minasidor.php">
                <label for="new-post-title">Rubrik (3-60 tecken)*</label><br>
                <input type="text" id="new-post-title" name="new-post-title" value="<?= $title; ?>"><br>
                <br>
                <label for="new-post-content">Innehåll (50-700 tecken)*</label><br>
                <textarea class="textarea" maxlength="700" id="new-post-content" name="new-post-content"><?= $content; ?></textarea><br>
                <div id="counter">
                    <span class="counter-status" id="currentCharactersCounter">Antal använda tecken: 0</span>
                    <span class="counter-status">/</span>
                    <span class="counter-status" id="maxCharacterAmount">700.</span><span class="counter-status" id="skriv-mer" style='font-Weight:bold'> Skriv mer!</span>
                </div>
                <br>
                <p>* = Obligatoriskt</p>
                <input type="submit" class="submit-button" value="Skicka in">
            </form><br>
        </div>
        <h3>Dina befintliga inlägg</h3>

        <div class="post-container">
            <?php
            //Bloggarens inlägg hämtas genom klassmetod och sparas i lista 
            $userPostsList = $postObject->getUserPosts($userEmail);

            //Om bloggaren har skrivit inlägg så ska de publiceras, annars kommer meddelande om att det inte finns några
            if ($userPostsList) {

                //Publicering av inlägg
                foreach ($userPostsList as $row) {
                    echo "<article>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p class='article-date'><i>Publicerad: " . $row['postdate'] . "</i></p>";
                    echo "<p>Författare: <a>" . $row['authorname'] . "</a></p>";
                    echo "<p>" . $row['content'] . "</p>";

                    //Länkar för ändring och radering av inlägg
                    echo "<div class='manage-post'>";
                    echo "<a class='link-change' href='postedit.php?id=" . $row['id'] . "'>Ändra</a>";
                    echo "<a class='link-erase' href='minasidor.php?delete=" . $row['id'] . "'>Ta bort</a>";
                    echo "</div>";
                    echo "</article>";
                }
            } else {
                echo "<p class='message'>Du har ännu inte skrivit något blogginlägg.</p>";
            }
            ?>
        </div>
        <h3>Hantera kontot</h3><br>
        <!-- Länk för att radera konto -->
        <a class="radera" href='eraseaccount.php'>Radera mitt konto</a>
        <p class="message">Om du raderar ditt konto försvinner även dina blogginlägg.</p>
    </div>
</section>

<?php
include("includes/footer.php");
?>