<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php

class Usermanager
{
    //properties
    private $db;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    // Ansluter till databas och sparar property db
    function __construct()
    {
        $this->db = new mysqli(/* borttaget av säkerhetsskäl */);
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning [' . $this->db->connect_error . ']');
        }
    }

    //Metod där lista på alla bloggare tas fram
    function getUserNames(): array
    {
        $sql = "SELECT firstname, lastname, id FROM users;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Set-metod för att kontrollera och lagra förnamn
    function setCorrectFirstName(string $firstname): bool
    {
        $lowercase = preg_match('@[a-z]@', $firstname);

        if ($firstname != "" && $lowercase) {
            $firstname = htmlentities($firstname, ENT_QUOTES, 'UTF-8');
            $firstname = $this->db->real_escape_string($firstname);
            $this->firstname = $firstname;
            return true;
        } else {
            $_SESSION['unacceptableFirstname'] = true;
            return false;
        }
    }

    //Set-metod för att kontrollera och lagra efternamn
    function setCorrectLastName(string $lastname): bool
    {
        $lowercase = preg_match('@[a-z]@', $lastname);

        if ($lastname != "" && $lowercase) {
            $lastname = htmlentities($lastname, ENT_QUOTES, 'UTF-8');
            $lastname = $this->db->real_escape_string($lastname);
            $this->lastname = $lastname;
            return true;
        } else {
            $_SESSION['unacceptableLastname'] = true;
            return false;
        }
    }

    //Set-metod för att kontrollera och lagra lösenord
    function setCorrectPassword(string $password): bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        //inklusive hashning
        if ($password != "" && $specialChars && $uppercase && $number && strlen($password) > 8) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $password;
            return true;
        } else {
            $_SESSION['unacceptablePassword'] = true;
            return false;
        }
    }

    //Set-metod för att kontrollera och lagra email
    function setCorrectEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = htmlentities($email, ENT_QUOTES, 'UTF-8');
            $email = $this->db->real_escape_string($email);

            //kontrollera att email-adressen inte redan är registrerad
            $sql = "SELECT * FROM users WHERE email = '$email';";
            $result = $this->db->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION['emailalreadyregistered'] = true;
                return false;
            }
            $this->email = $email;
            return true;
        } else {
            $_SESSION['unacceptableEmail'] = true;
            return false;
        }
    }

    //Get-metoder för att ta fram förnamn, efternamn, email och lösenord
    function getFirstname(): string
    {
        return $this->firstname;
    }

    function getLastname(): string
    {
        return $this->lastname;
    }

    function getEmail(): string
    {
        return $this->email;
    }

    function getPassword(): string
    {
        return $this->password;
    }

    //Registrering av ny användare/bloggare
    function addNewUser(): bool
    {
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $_SESSION['successfulRegistration'] = true;
        $sql = "INSERT INTO users (firstname, lastname, password, email) VALUES ('$firstname', '$lastname', '$password', '$email');";
        return mysqli_query($this->db, $sql);
    }

    //Set-metod för att kontrollera att inmatad email har rätt format och låg risk för skadlig kod
    function setloginemail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = htmlentities($email, ENT_QUOTES, 'UTF-8');
            $email = $this->db->real_escape_string($email);
            return true;
        } else {
            $_SESSION['incorrectEmail'] = true;
            return false;
        }
    }

    //Metod för inloggning
    function loginUser(string $email, string $password): bool
    {
        if (!$this->setloginemail($email)) {
            return false;
        }
        $sql = "SELECT * FROM users WHERE email = '$email';";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
            $stored_firstname = $row['firstname'];
            $stored_lastname = $row['lastname'];
            if (password_verify($password, $stored_password)) {
                $_SESSION['email'] = $email;
                $_SESSION['firstname'] = $stored_firstname;
                $_SESSION['lastname'] = $stored_lastname;
                $_SESSION['loggedin'] = true;
                return true;
            } else {
                $_SESSION['incorrectPassword'] = true;
                return false;
            }
        } else {
            $_SESSION['unknownUser'] = true;
            return false;
        }
    }

    //Metod för att radera konto
    function deleteAccount(string $email): bool
    {
        $sql = "DELETE FROM users WHERE email = '$email';";
        $result = $this->db->query($sql);
        return $result;
    }

    //Metod för att radera en användares alla inlägg
    function deleteAllPostsFromUser(string $email): bool
    {
        $sql = "DELETE FROM posts WHERE authoremail = '$email';";
        $result = $this->db->query($sql);
        return $result;
    }
}

?>