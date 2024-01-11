<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");
?>

<?php
//Om en användare inte är nyregistrerad så ska användaren inte nå denna sida
if (!$_SESSION['successfulRegistration']) {
    header("location:register.php");
}
?>

<?php
include("includes/header.php");
?>

<section class="section finishedreg">
    <h2>Registrering godkänd</h2>
    <a class="intro-link-button" href="login.php">Logga in</a>
    <picture>
        <source type="image/webp" srcset="includes/images/student2webp.webp">
        <img src="includes/images/student2jpg.jpg" alt="">
    </picture>
</section>

<?php
include("includes/footer.php");
?>