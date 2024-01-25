<?php
/* Denna fil är del av programmeringskoden för projektarbetet i kursen Webbutveckling II, ett arbete skapat av Cecilia Edvardsson */
?>

<?php

class Postmanager
{
    //properties
    private $db;
    private $title;
    private $content;

    // Ansluter till databas, propertyn db sparas
    function __construct()
    {
        $this->db = new mysqli('studentmysql.miun.se', 'ceed2200', /* Obs, lösenord borttaget av säkerhetsskäl */ 'ceed2200');
        if ($this->db->connect_errno > 0) {
            die('Fel vid anslutning till databas. Vänligen kontakta webbadministratören. [' . $this->db->connect_error . ']');
        }
    }

    //Metod där de 5 senaste blogginläggen tas fram
    function getFiveLatestPosts(): array
    {
        $sql = "SELECT * FROM posts ORDER BY postdate DESC LIMIT 5;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Metod där en bloggares email hämtas
    function getUserEmail(int $id): string
    {
        $sql = "SELECT * FROM users WHERE id = '$id';";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userEmail = $row['email'];
        }
        return $userEmail;
    }

    //Metod där en bloggares fulla namn hämtas
    function getUserFullname(int $id): string
    {
        $sql = "SELECT * FROM users WHERE id = '$id';";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userFirstname = $row['firstname'];
            $userLastname = $row['lastname'];
            $userFullName = $userFirstname . " " . $userLastname;
        }
        return $userFullName;
    }

    //Metod där en bloggares alla inlägg hämtas
    function getUserPosts(string $userEmail): array
    {
        $sql = "SELECT * FROM posts WHERE authoremail='$userEmail' ;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Set-metod för att kontrollera ett blogginläggs titel
    function setTitle(string $title): bool
    {
        $lowercase = preg_match('@[a-z]@', $title);

        if ($title == "" || !$lowercase || strlen($title) < 3 || strlen($title) > 60) {
            $_SESSION['titlemissing'] = true;
            return false;
        } else {
            $title = strip_tags($title);
            $title = $this->db->real_escape_string($title);
            $this->title = $title;
            return true;
        }
    }

    //Set-metod för att kontrollera ett blogginläggs innehåll
    function setContent(string $content): bool
    {
        $lowercase = preg_match('@[a-z]@', $content);
        if ($content == "" || !$lowercase || strlen($content) < 50 || strlen($content) > 700) {
            $_SESSION['contentmissing'] = true;
            return false;
        } else {
            $content = strip_tags($content);
            $content = $this->db->real_escape_string($content);
            $this->content = $content;
            return true;
        }
    }

    //Get-metoder för att hämta blogginläggs titel och innehåll
    function getTitle(): string
    {
        return $this->title;
    }

    function getContent(): string
    {
        return $this->content;
    }

    //Metod för att lagra nytt blogginlägg
    function addNewPost(string $userEmail, string $userFullName): bool
    {
        $title = $this->getTitle();
        $content = $this->getContent();

        $sql = "INSERT INTO posts (title, content, authoremail, authorname) VALUES ('$title', '$content', '$userEmail', '$userFullName');";
        return mysqli_query($this->db, $sql);
    }

    // Metod för att ta bort ett blogginlägg från databasen
    function deletePost(int $id)
    {
        $sql = "DELETE FROM posts WHERE id='$id';";
        mysqli_query($this->db, $sql);
        header("location:minasidor.php?posterased");
    }

    //get-metod för att hämta tabellrad för ett särskilt blogginlägg
    function getSpecificPost(int $postID): array
    {
        $sql = "SELECT * FROM posts WHERE id = '$postID';";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    //Metod där en bloggares specifika inlägg hämtas
    function getOneUserPost(int $postID): array
    {
        $sql = "SELECT * FROM posts WHERE id='$postID' ;";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Metod för att uppdatera ett blogginlägg
    function updatePost(int $postID): bool
    {
        $id = intval($postID);

        $sql = "UPDATE posts SET title='" . $this->title . "', content='" . $this->content . "' WHERE id='" . $id . "';";
        $this->db->query($sql);
        return true;
    }

    //Metod för att kontrollera att den användare som försöker radera eller ändra ett inlägg även är skapare till inlägget
    function checkCorrectUser(int $postID, string $userEmail): bool
    {
        $sql = "SELECT * FROM posts WHERE id = '$postID';";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_userEmail = $row['authoremail'];
            if ($stored_userEmail == $userEmail) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>