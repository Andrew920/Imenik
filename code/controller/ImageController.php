<?php

require_once "model/ImageDB.php";
class ImageController {
    public static function getTestImg() {
        return ImageDB::getTestImg();
    }
}
?>