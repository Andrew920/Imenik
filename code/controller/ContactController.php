<?php

require_once("model/ContactDB.php");

class ContactController {
    public static function add() {
        if (!preg_match('/[a-zA-Z]+/', $_POST['ime']) || strlen($_POST['ime']) == 0)
            echo "Ime ni pravilno! Dovoljene samo crke od a do z. OBVEZNO !";
        else if(!preg_match('/[a-zA-Z]+/', $_POST['priimek']) || strlen($_POST['priimek']) == 0)
            echo "Priimek ni pravilen! Dovoljene samo crke od a do z. OBVEZNO !";
        else if(!preg_match('/[0-9]{9}/', $_POST['telst']) && strlen($_POST['telst']) != 0)
            echo "Telefonska stevilka ni pravilna! Lahko so samo stevilke, obvezno 9 stevk.";
        else if(!preg_match('/[a-zA-Z]+[@][a-zA-Z]+[.][a-zA-Z]+/', $_POST['email']) && strlen($_POST['email']) != 0)
            echo "eMail ni pravilen!";
        else if(!preg_match('/[[0-9]+/', $_POST['starost']) && strlen($_POST['starost']) != 0)
            echo "Starost ni pravilna! Dovoljena so le pozitivna stevila.";
        else {
            echo ContactDB::add($_POST['ime'], $_POST['priimek'], $_POST['telst'], $_POST['email'], $_POST['starost'], $_POST['setting']);
        }
    }
    public static function update() {
        if (!preg_match('/[a-zA-Z]+/', $_POST['ime']) || strlen($_POST['ime']) == 0)
            echo "Ime ni pravilno! Dovoljene samo crke od a do z. OBVEZNO !";
        else if(!preg_match('/[a-zA-Z]+/', $_POST['priimek']) || strlen($_POST['priimek']) == 0)
            echo "Priimek ni pravilen! Dovoljene samo crke od a do z. OBVEZNO !";
        else if(!preg_match('/[0-9]{9}/', $_POST['telst']) && strlen($_POST['telst']) != 0)
            echo "Telefonska stevilka ni pravilna! Lahko so samo stevilke, obvezno 9 stevk.";
        else if(!preg_match('/[a-zA-Z]+[@][a-zA-Z]+[.][a-zA-Z]+/', $_POST['email']) && strlen($_POST['email']) != 0)
            echo "eMail ni pravilen!";
        else if(!preg_match('/[[0-9]+/', $_POST['starost']) && strlen($_POST['starost']) != 0)
            echo "Starost ni pravilna! Dovoljena so le pozitivna stevila.";
        else {
            echo ContactDB::update($_POST['id'], $_POST['ime'], $_POST['priimek'], $_POST['telst'], $_POST['email'], $_POST['starost']);
        }
    }
    public static function remove() {
        echo ContactDB::remove($_POST['id']);
    }
    function isLoggedIn() {
        if (isset($_SESSION['user'])) 
            return true;
        return false;
    }
}

?>