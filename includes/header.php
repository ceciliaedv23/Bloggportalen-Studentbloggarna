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
</head>

<body>
    <header>
        <h1><a href=index.php>Studentbloggarna</a></h1>
        <div class="menubutton">
            <button class="menu">
                <span id="menu-icon" class="menu-icon">
                    <span class="menu-text">Meny</span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                    <span class="menu-line"></span>
                </span>
            </button>
        </div>
        <nav>
            <ul id="navlist">
                <li><a href="index.php">Start</a></li>
                <li><a href="register.php">Registrera dig</a></li>
                <li><a href="minasidor.php">Mina sidor</a></li>
                <li><a href="about.php">Om oss</a></li>
            </ul>
        </nav>
    </header>
    <main>