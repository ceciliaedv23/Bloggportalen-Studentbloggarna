<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php
spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});

session_start();
?>