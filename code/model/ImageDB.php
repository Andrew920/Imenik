<?php
// require_once "model/DBinit.php";
class ImageDB {
    public static function getTestImg() {
        $instance = DBinit::getInstance();
        $query = "SELECT data FROM images;";
        $stmt = $instance->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchColumn(0);
        } else {
            return 'slika';
        }
    }
}

?>