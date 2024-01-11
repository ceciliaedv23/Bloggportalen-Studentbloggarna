<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");
?>

<?php
//Om en användare inte är inloggad så ska det inte gå att komma in på denna sida
if (!$_SESSION['loggedin']) {
    $_SESSION['loginrequired'] = true;
    header("location:login.php");
}
?>

<?php

//Skapar objekt av klass för att använda klassens metoder
$postObject = new Postmanager();

$userEmail = $_SESSION['email'];
$postID = intval($_GET['id']);

//Tar fram lagrade data för aktuellt blogginlägg om det är rätt användare
if ($postObject->checkCorrectUser($postID, $userEmail)) {
    $specificPost = $postObject->getSpecificPost($postID);

    $title = $specificPost['title'];
    $content = $specificPost['content'];

    //Om formuläret fyllts i och skickats in kontrolleras värden och lagras på nytt om godkända, annars kommer felmeddelanden
    if (isset($_POST['title'])) {

        $newTitle = $_POST['title'];
        $newContent = $_POST['new-post-content'];

        $success = true;

        if (!$postObject->setTitle($newTitle)) {
            $_SESSION['postnotupdated'] = true;
            $success = false;
        }

        if (!$postObject->setContent($newContent)) {
            $_SESSION['postnotupdated'] = true;
            $success = false;
        }

        //Om alla värden godkänns så lagras inlägget
        if ($success) {
            if ($postObject->updatePost($postID)) {
                $_SESSION['postupdated'] = true;
                header("Location: minasidor.php");
            } else {
                $_SESSION['postnotupdated'] = true;
            }
        }
    }
} else {
    header("Location: index.php");
}
?>

<?php
include("includes/header.php");
?>

<section class="section postedit">
    <?php
    echo "<h2> Välkommen till din egen bloggsida, " . $_SESSION['firstname'] . "!</h2>";
    ?>
    <div class="postedit-container">
        <!-- Länk för utloggning -->
        <a class='logout-button' href='logout.php'>Logga ut</a>
        <br>
        <br>
        <br>

        <?php
        //Utskrift av eventuella felmeddelanden gällande att uppdateringen inte gått igenom
        if (isset($_SESSION['postnotupdated'])) {
            echo "<p class='errormessage bigmessage'>Blogginlägget är inte uppdaterat.<br> Uppdatera det ursprungliga inlägget på nytt enligt nedan.</p>";
        }
        unset($_SESSION['postnotupdated']);
        ?>

        <?php
        //Utskrift av eventuella felmeddelanden gällande titel och innehåll av ändrat blogginlägg
        if (isset($_SESSION['titlemissing'])) {
            echo "<p class='errormessage'>- Titeln måste innehålla minst 3 och max 60 tecken varav dessa består av minst 1 liten bokstav.</p>";
        }
        unset($_SESSION['titlemissing']);

        if (isset($_SESSION['contentmissing'])) {
            echo "<p class='errormessage'>- Innehållet måste bestå av minst 50 och högst 700 tecken.</p>";
        }
        unset($_SESSION['contentmissing']);
        ?>

        <h3>Ändra valt blogginlägg</h3>

        <!-- Formulär för ändrat blogginlägg -->
        <form method=POST>
            <label for="title">Rubrik (3-60 tecken) *</label><br>
            <input class="single-text-field" type="text" id="title" name="title" value="<?= $title; ?>"><br><br>
            <label for="new-post-content">Innehåll (50-700 tecken) *</label><br>
            <textarea class="textarea" maxlength="700" id="new-post-content" name="new-post-content"><?= $content; ?></textarea><br>
            <div id="counter">
                <span class="counter-status" id="currentCharactersCounter">Antal använda tecken: 0</span>
                <span class="counter-status">/</span>
                <span class="counter-status" id="maxCharacterAmount">700.</span><span class="counter-status" id="skriv-mer" style='font-Weight:bold'> Skriv i textfältet för att aktivera räkningen!</span>
            </div>
            <p>* = Obligatoriskt</p>
            <input class="submit-button" type="submit" value="Uppdatera nyhet">
        </form><br>
        <br>
        <a class="link-tillbakaminasidor" href=minasidor.php><i class="fa-solid fa-arrow-left" style="color: #193e1d; margin-right:10px; padding: 5% 0;"></i>Tillbaka till Mina sidor</a>
    </div>
</section>

<?php
include("includes/footer.php");
?>