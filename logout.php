<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
/* Utloggning */
session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit();
?>