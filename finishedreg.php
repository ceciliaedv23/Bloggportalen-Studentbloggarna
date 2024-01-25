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

<section class="section grid-container-register">
    <div class="grid-register-1">
    <h2>Perfekt! Nu är du registrerad.</h2><br><br>
    <a class="section-intro-button" href=login.php>Logga in på Mina sidor</a><br>
    </div>

    <div class="grid-register-2">
        <picture>
            <source type="image/webp" srcset="includes/images/student2webp.webp">
            <img src="includes/images/student2jpg.jpg" alt="">
        </picture>
    </div>
</section>

<?php
include("includes/footer.php");
?>