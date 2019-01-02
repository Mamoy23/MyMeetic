<?php
session_start();

include("controllers/controller.php");
include("models/model.php");

if (!isset($_GET['page']))
    include("views/view_signin.php");
else {
    $yo = new Controller();
    switch($_GET['page']){
        case "signin":
            $yo->signin();
            break;
        case "login":
            $yo->login();
            break;
        case "profil":
            $yo->profil();
            break;
        case "logout":
            $yo->logout();
            break;
    }
}