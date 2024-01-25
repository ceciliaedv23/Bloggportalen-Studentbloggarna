<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klass för att använda klassens metoder
$userObject = new Usermanager;
?>

<?php
//Om en användare är inloggad så ska det inte gå att logga in igen
if (isset($_SESSION['loggedin'])) {
    header("location:minasidor.php");
}
?>

<?php
//Om formuläret fyllts i och skickats in kontrolleras värden och lagras om godkända, annars kommer felmeddelanden
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //Om metoden loginUser accepterar värdena så loggas man in
    if ($userObject->loginUser($email, $password)) {
        header("Location: minasidor.php");
    } else {
        $_SESSION['failedLogin'] = true;
    }
}
?>

<?php
include("includes/header.php");
?>

<section class="section login">
    <?php
    //Meddelande om att inloggning krävs
    if (isset($_SESSION['loginrequired'])) {
        echo "<p class='errormessage'>Inloggning krävs.</p>";
    }
    unset($_SESSION['loginrequired']);
    ?>
    <h2>Logga in till Mina sidor</h2>

    <!-- Formulär för att logga in -->
    <form method="POST" action="login.php">
        <label for="email">Email *</label><br>
        <input type="text" id="email" name="email" value="<?= $email; ?>"><br>

        <?php
        //Felmeddelande om felaktigt format för email
        if (isset($_SESSION['incorrectEmail'])) {
            echo "<p class='errormessage'>E-postadressen har inte ett korrekt format.</p>";
        }
        unset($_SESSION['incorrectEmail']);

        //Felmeddelande om att email inte tillhör någon användare
        if (isset($_SESSION['unknownUser'])) {
            echo "<p class='errormessage'>Angiven e-postadress tillhör ingen användare.</p>";
        }
        unset($_SESSION['unknownUser']);
        ?>
        <br>
        <label for="password">Lösenord *</label><br>
        <input type="password" id="password" name="password"><br>

        <?php
        //Felmeddelande om felaktigt lösenord
        if (isset($_SESSION['incorrectPassword'])) {
            echo "<p class='errormessage'>Felaktigt lösenord.</p>";
        }
        unset($_SESSION['incorrectPassword']);
        ?>
        <br>
        <p>* = Obligatoriskt</p>
        <input type="submit" class="submit-button" value="Logga in">

        <?php
        //Felmeddelande om misslyckad inloggning generellt
        if (isset($_SESSION['failedLogin'])) {
            echo "<br><p class='errormessage'>Inloggningen misslyckades. Vänligen åtgärda de felaktiga uppgifterna.</p> </p>";
        }
        unset($_SESSION['failedLogin']);
        ?>
        <p>Glömt lösenord? Kontakta oss på info@studentbloggarna.se</p>
    </form>
</section>

<?php
include("includes/footer.php");
?>