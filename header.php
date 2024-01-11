<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentbloggarna</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/5.css">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <!-- Ikoner från Font Awesome -->
    <script src="https://kit.fontawesome.com/9706ef27d6.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1><a href=index.php>Studentbloggarna</a></h1>
        <div class="menubutton">
            <button class="menu">
                <span id="menu-icon" class="menu-icon">
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </span>
            </button>
        </div>
        <nav>
            <ul id="navlist">
                <li><a href="index.php"><i class="fa-solid fa-house" style="color: #fafafa; padding-right: 10px;"></i>HEM</a></li>
                <li><a href="login.php"><i class="fa-solid fa-key" style="color: #ffffff; padding-right: 10px;"></i>LOGGA IN</a></li>
                <li><a href="register.php"><i class="fa-solid fa-pen-to-square" style="color: #ffffff; padding-right: 10px;"></i>REGISTRERING</a></li>
                <li><a href="minasidor.php"><i class="fa-solid fa-user" style="color: #ffffff; padding-right: 10px;"></i>MINA SIDOR</a></li>
                <li><a href="about.php"><i class="fa-solid fa-circle-info" style="color: #ffffff; padding-right: 10px;"></i>OM OSS</a></li>
            </ul>
        </nav>
    </header>
    <main>