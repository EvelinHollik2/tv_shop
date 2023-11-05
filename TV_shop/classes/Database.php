<?php

class Database {

    private $db = null;

    public function __construct($host, $username, $pass, $db) {
        $this->db = new mysqli($host, $username, $pass, $db);
    }

    public function login($username, $pass) {
        //-- jelezzük a végrehajtandó SQL parancsot 
        $stmt = $this->db->prepare('SELECT * FROM users WHERE users.username LIKE ?;');
        //-- elküdjük a végrehajtáshoz szükséges adatokat
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            //-- sikeres végrehajtás után lekérjük az adatokat
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            //var_dump(password_hash($pass, PASSWORD_ARGON2I));
            var_dump($row, $pass);
            if ($pass == $row['password']) {
                //-- felhasználónév és jelszó helyes
                $_SESSION['username'] = $row['username'];
                $_SESSION['login'] = true;
                return true;
            }
        } else {
            $_SESSION['username'] = '';
            $_SESSION['login'] = false;
            return false;
        }
        // Free result set
        $result->free_result();
        return false;
    }

    /* email ellenörző @ */

    public function regist($email, $username, $pass) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`userid`, `email`, `username`, `password`) VALUES (NULL,?,?,?)");
        $stmt->bind_param("sss", $email, $username, $pass);

        try {
            if ($stmt->execute()) {
                $_SESSION['login'] = true;
                header("location: index.php");
            }
        } catch (Exception $e) {

            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function osszesTV() {
        $result = $this->db->query("SELECT * FROM `termekek`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKivalasztottTV($id) {
        $result = $this->db->query("SELECT * FROM `termekek` WHERE `termekid` = ''" . $id);
        return $result->fetch_assoc();
    }

    public function setKivalasztottTV($termekid, $termek_nev, $felbontas, $kepatlo, $termek_ar) {
        $stmt = $this->db->prepare("UPDATE `termekek` SET `termek_nev`= ?,`felbontas`= ?,`kepatlo`= ?,`termek_ar`= ? WHERE termekid= ?");
        $stmt->bind_param('issss', $termekid, $termek_nev, $felbontas, $kepatlo, $termek_ar);
        return $stmt->execute();
    }
}