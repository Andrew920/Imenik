<?php
require_once "model/DBinit.php";
require_once "model/UserDB.php";
class ContactDB {
    public static function add($ime='', $priimek='', $telst='', $email='', $starost='', $setting='3') {
        session_start();
        $temp = UserDB::getUserId();
        if ($temp == 0) return;

        $instance = DBinit::getInstance();

        $ime = filter_var($ime, FILTER_SANITIZE_STRING);
        $priimek = filter_var($priimek, FILTER_SANITIZE_STRING);
        $telst = filter_var($telst, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $starost = filter_var($starost, FILTER_SANITIZE_NUMBER_INT);
        $setting = filter_var($setting, FILTER_SANITIZE_NUMBER_INT);

        $query = "INSERT INTO contact (id_user, ime, priimek, telst, email, starost, modified, setting) VALUES (:id_user, :ime, :priimek, :telst, :email, :starost, :modified, :setting);";
        $stmt = $instance->prepare($query);
        
        $stmt->bindParam('id_user', $temp, PDO::PARAM_INT);
        $stmt->bindParam('ime', $ime, PDO::PARAM_STR);
        $stmt->bindParam('priimek', $priimek, PDO::PARAM_STR);
        $stmt->bindParam('telst', $telst, PDO::PARAM_STR);
        $stmt->bindParam('email', $email, PDO::PARAM_STR);

        if ($starost != '')$stmt->bindParam('starost', $starost, PDO::PARAM_INT);
        else $stmt->bindParam('starost', $starost, PDO::PARAM_NULL);

        if ($setting != '')$stmt->bindParam('setting', $setting, PDO::PARAM_INT);
        else $stmt->bindParam('setting', $setting, PDO::PARAM_NULL);

        $stmt->bindParam('modified', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $stmt->execute();

        return $instance->lastInsertId(); 
    }

    public static function update($id, $ime, $priimek, $telst, $email, $starost) {
        $instance = DBinit::getInstance();
        if ($ime != '') {
            $ime = filter_var($ime, FILTER_SANITIZE_STRING);
            $query = "UPDATE contact SET ime = :ime WHERE id = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('ime', $ime, PDO::PARAM_STR);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        if ($priimek != '') {
            $priimek = filter_var($priimek, FILTER_SANITIZE_STRING);
            $query = "UPDATE contact SET priimek = :priimek WHERE id = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('priimek', $priimek, PDO::PARAM_STR);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        if ($telst != '') {
            $telst = filter_var($telst, FILTER_SANITIZE_STRING);
            $query = "UPDATE contact SET telst = :telst WHERE id = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('telst', $telst, PDO::PARAM_STR);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        if ($email != '') {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $query = "UPDATE contact SET email = :email WHERE id = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        if ($starost != '') {
            $starost = filter_var($starost, FILTER_SANITIZE_NUMBER_INT);
            $query = "UPDATE contact SET starost = :starost WHERE id = :id";
            $stmt = $instance->prepare($query);
            $stmt->bindParam('starost', $starost, PDO::PARAM_INT);
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public static function remove($id) {
        $instance = DBinit::getInstance();
        $query = "DELETE FROM contact WHERE id = :id";
        $stmt = $instance->prepare($query);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>