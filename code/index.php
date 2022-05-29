<?php

require_once "controller/ImageController.php";
require_once "controller/UserController.php";
require_once "controller/ContactController.php";
require_once "ViewHelpler.php";
define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";
$urls = [
    "" => function () {
        ViewHelper::render("view/home-user.php");
    },
    "user/contact/add" => function () {
        ContactController::add();
    },
    "user/contact/update" => function () {
        ContactController::update();
    },
    "user/contact/remove" => function () {
        ContactController::remove();
    },
    "user/register" => function () {
        UserController::register();
    },
    "user/login" => function () {
        UserController::Login();
    },
    "user/logout" => function () {
        UserController::Logout();
    },
    "user/contact/list" => function () {
        echo UserController::getContacts();
    }
];
try {
    if (!(strpos($path, "image") === false)) {
        header('Content-Type: image/jpeg');
        echo ImageController::getTestImg();
    }
    if (isset($urls[$path])) {
        $urls[$path]();
    }
} catch (Exception $e){
    echo $e;
}