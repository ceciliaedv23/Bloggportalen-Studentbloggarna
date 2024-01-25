<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

//Skapar objekt av klass för att använda klassens metoder
$userObject = new Usermanager;
?>

<?php
//Om en användare är inloggad så ska det inte gå att registrera sig igen
if (isset($_SESSION['loggedin'])) {
    header("location:minasidor.php");
}
?>

<?php
//Om formuläret fyllts i och skickats in kontrolleras värden och lagras om godkända, annars kommer felmeddelanden
if (isset($_POST['firstname'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $success = true;

    if (!$userObject->setCorrectFirstName($firstname)) {
        $success = false;
    } else {
        $firstname = $userObject->getFirstname();
    }

    if (!$userObject->setCorrectLastName($lastname)) {
        $success = false;
    } else {
        $lastname = $userObject->getLastname();
    }

    if (!$userObject->setCorrectEmail($email)) {
        $success = false;
    } else {
        $email = $userObject->getEmail();
    }

    if (!$userObject->setCorrectPassword($password)) {
        $success = false;
    } else {
        $password = $userObject->getPassword();
    }

    //Om alla värden godkänns så lagras användaren
    if ($success) {
        if ($userObject->addNewUser()) {
            header("location:finishedreg.php");
        }
    } else {
        $_SESSION['failedRegistration'] = true;
    }
}
?>

<?php
include("includes/header.php");
?>

<section class="section grid-container-register">
    <div class="grid-register-1">
        <h2>Registrera dig här </h2>
        <p class="paragraph-structure">Fyll i nedanstående uppgifter och godkänn våra användarvillkor för att registrera ditt användarkonto.<br><br>
            Lösenordet måste bestå av minst 8 tecken varav dessa innehåller minst 1 siffra, 1 specialtecken och 1 stor bokstav.</p>

        <!-- Formulär för registrering -->
        <form method="POST" action="register.php">
            <label for="firstname">Förnamn *</label><br>
            <input type="text" id="firstname" name="firstname" value="<?= $firstname; ?>"><br>

            <?php
            //Felmeddelande om felaktigt format för förnamn
            if (isset($_SESSION['unacceptableFirstname'])) {
                echo "<p class='errormessage'>Förnamnet har inte ett korrekt format.</p>";
            }
            unset($_SESSION['unacceptableFirstname']);
            ?>
            <br>
            <label for="lastname">Efternamn *</label><br>
            <input type="text" id="lastname" name="lastname" value="<?= $lastname; ?>"><br>

            <?php
            //Felmeddelande om felaktigt format för efternamn
            if (isset($_SESSION['unacceptableLastname'])) {
                echo "<p class='errormessage'>Efternamnet har inte ett korrekt format.</p>";
            }
            unset($_SESSION['unacceptableLastname']);
            ?>
            <br>
            <label for="email">E-postadress *</label><br>
            <input type="text" id="email" name="email" value="<?= $email; ?>"><br>
            <?php

            //Felmeddelande om felaktigt format för email-adress
            if (isset($_SESSION['unacceptableEmail'])) {
                echo "<p class='errormessage'>E-postadressen har inte ett korrekt format.</p>";
            }
            unset($_SESSION['unacceptableEmail']);

            //Felmeddelande om tidigare registrering
            if (isset($_SESSION['emailalreadyregistered'])) {
                echo "<p class='errormessage'>E-postadressen är redan registrerad. Välj en ny.</p>";
            }
            unset($_SESSION['emailalreadyregistered']);
            ?>
            <br>
            <label for="password">Lösenord *</label><br>
            <input type="password" id="password" name="password"><br>
            <?php

            //Felmeddelande om felaktigt format för lösenord
            if (isset($_SESSION['unacceptablePassword'])) {
                echo "<p class='errormessage'>Lösenordet har inte ett korrekt format.</p>";
            }
            unset($_SESSION['unacceptablePassword']);
            ?>
            <br>
            <p>* = Obligatoriskt</p>
            <p>Genom att klicka på "Registrera mig" godkänner du <a class="userconditions" id="userconditions">användarvillkoren.</a></p><br>
            <input class="button" type="submit" value="Registrera mig">
            <?php

            //Felmeddelande om misslyckad registrering
            if (isset($_SESSION['failedRegistration'])) {
                echo "<p class='errormessage'>Registreringen misslyckades. Vänligen åtgärda uppgivna felaktigheter.</p>";
            }
            unset($_SESSION['failedRegistration']);
            ?>
        </form>
    </div>

    <div class="grid-register-2">
        <picture>
            <source type="image/webp" srcset="includes/images/student1webp.webp">
            <img src="includes/images/student1jpg.jpg" id="grid-register-2-img" alt="">
        </picture>
    </div>
</section>

<?php
include("includes/footer.php");
?>