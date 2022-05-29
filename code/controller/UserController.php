<?php

require_once("model/UserDB.php");

class UserController {
    public static function register() {
        session_start();
        $napaka = "Vnesite podatke, geslo se mora ponoviti in ne sme biti enako uporabniksem imenu";
        if (isset($_POST["user"]))
            $napaka = UserDB::validRegister($_POST["user"], $_POST["geslo"], $_POST["ponovitev"]);
        if (isset($_SESSION['user'])){
            ViewHelper::render("view/home-user.php");
        } else if ($napaka == "") {
            UserDB::register($_POST["user"], $_POST["geslo"]);
            $_SESSION["user"] = $_POST["user"];
            $_COOKIE['id'] = UserDB::getUserId($_POST["user"]);
            ViewHelper::render("view/home-user.php");
        } else {
            ViewHelper::render("view/register.php", array("napaka" => $napaka));
        }
    }
    public static function login() {
        if (isset($_SESSION['user'])) {
            ViewHelper::render("view/home-user.php");
        }
        else if (isset($_POST["user"]) && UserDB::ValidCredentials($_POST["user"], $_POST["pass"])) {
            session_start();
            $_SESSION['user'] = $_POST["user"];
            $_COOKIE['id'] = UserDB::getUserId($_POST["user"]);
            ViewHelper::render("view/home-user.php");
        } else {
            ViewHelper::render("view/login.php");
        }
    }
    public static function logout() {
        session_start();
        $_SESSION['user'] = "";
        unset($_SESSION["user"]);
        session_unset();
        session_destroy();
        ViewHelper::render("view/home-user.php");
    }
    public static function getContacts() {
        session_start();
        if (isset($_SESSION["user"]) && $_SESSION["user"] != "") $id = UserDB::getUserId();
        else $id = 0;
        $contacts = UserDB::getUserContacts($id);
        for($i = 0; $i < sizeof($contacts) && $id != 0; $i++) {
            if ($contacts[$i]['setting'] == '2')
                $contacts[$i]['setting'] = '3';
        }
        echo json_encode($contacts);
    }
}

?>