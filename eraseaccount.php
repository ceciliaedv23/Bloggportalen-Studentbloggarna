<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
include("includes/config.php");

$userObject = new Usermanager();
$userEmail = $_SESSION['email'];
?>

<?php
/* Metoder körs för radering av konto och användarens inlägg samt utloggning */
if ($userObject->deleteAccount($userEmail)) {
    $userObject->deleteAllPostsFromUser($userEmail);
    session_start();
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
}
?>