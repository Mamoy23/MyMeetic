<?php
session_start();
setlocale(LC_ALL, 'fr_FR.UTF8');

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
        case "meetic":
            if(!empty($_SESSION)){
                $yo->meetic();
            }
            else{
                echo "Cet espace est réservé à nos membres! Sorry :)";
            }
            break;
        case "logout":
            $yo->logout();
            break;
        case "delete":
            $yo->deleteMember();
            break;
        case "tchat":
            $yo->tchat();
            break;
    }
}