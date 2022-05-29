<?php
require_once "model/DBinit.php";
class UserDB {
    public static function ValidCredentials($user, $pass) {
        $instance = DBinit::getInstance();
        $user = filter_var($user, FILTER_SANITIZE_STRING);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $query = "SELECT COUNT(id) FROM users WHERE username = :username AND pass = :password";
        $stmt = $instance->prepare($query);
        $stmt->bindParam('username', $user, PDO::PARAM_STR);
        $stmt->bindParam('password', $pass, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn(0) == 1;
    }
    public static function validRegister($user, $pass, $ponovitev) {
        if (strlen($user) == 0 || strlen($pass) == 0){
            return "Ime in geslo morata biti izpolnjena";
        }
        if ($pass != $ponovitev) {
            return "Gesli se ne ujemata";
        } else if ($user == $pass) {
            return "Uporabnisko ime in geslo morata biti razlicna";
        }
        $instance = DBinit::getInstance();
        $user = filter_var($user, FILTER_SANITIZE_STRING);
        $query = "SELECT COUNT(id) FROM users WHERE username = :username";
        $stmt = $instance->prepare($query);
        $stmt->bindParam('username', $user, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn(0) != 0) {
            return "Uporabnik ze obstaja";
        }

        return "";
    }
    public static function register($user, $pass) {
        $instance = DBinit::getInstance();
        $user = filter_var($user, FILTER_SANITIZE_STRING);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $query = "INSERT INTO users(username, pass) VALUES (:username, :password)";
        $stmt = $instance->prepare($query);
        $stmt->bindParam('username', $user, PDO::PARAM_STR);
        $stmt->bindParam('password', $pass, PDO::PARAM_STR);
        $stmt->execute();
    }
    public static function getUserId() {
        // session_start();
        if (isset($_SESSION['user'])) {
            $instance = DBinit::getInstance();
            $query = "SELECT id FROM users WHERE username = :user";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('user', $_SESSION['user'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn(0);
        }
        return 0;
    }
    public static function getUserContacts($id) {
        $instance = DBinit::getInstance();

        if ($id != 0) {
            $query = "SELECT * FROM contact WHERE id_user = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
        } else {
            $query = "SELECT * FROM contact WHERE setting = 1 OR setting = 2";
            $stmt = $instance->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>