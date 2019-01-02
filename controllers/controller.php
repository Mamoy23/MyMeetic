<?php

class Controller{

    public function redirectTo($url) {
        header("Location: $url");
        exit;
    }

    public function signin(){
        $error_msg ="";

        if (isset($_POST['name']) && isset($_POST['firstname']) &&isset($_POST['pseudo']) && isset($_POST['birthday']) && isset($_POST['birthmonth']) && isset($_POST['birthyear']) && isset($_POST['gender']) && isset($_POST['city']) && isset($_POST['email']) && isset($_POST['password']) &&isset($_POST['verif_password'])
        && !empty($_POST['name']) && !empty($_POST['firstname']) &&!empty($_POST['pseudo']) && !empty($_POST['birthday']) && !empty($_POST['birthmonth']) && !empty($_POST['birthyear']) && !empty($_POST['gender']) && !empty($_POST['city']) && !empty($_POST['email']) && !empty($_POST['password']) &&!empty($_POST['verif_password'])){
            if($_POST['birthyear'] <= 2001){
                if($_POST['password'] === $_POST['verif_password']){
                    $member = new Member();
                    if($member->addMember() == "23000"){
                        $error_msg = "Cette adresse mail est déjà utilisée!";
                    }
                }
                else{
                    $error_msg = "Les mots de passe saisis ne correspondent pas";
                }
            }
            else{
                $error_msg = "Ce site est réservé aux majeurs";
            }
        }
        else{
            $error_msg = "Merci de remplir tous les champs";
        }
 
        if(empty($error_msg)){
            $_SESSION = ['email'];
            $this->redirectTo('?page=profil');
        }
        else{
            include("views/view_signin.php");
        }
        
    }

    public function login(){
        if (isset($_POST['co_email']) && isset($_POST['co_password']) &&!empty($_POST['co_email']) && !empty($_POST['co_password'])){
            $yo = new Member();
            $co = $yo->coMember();
            $isPasswordCorrect = password_verify($_POST['co_password'], $co['mdp']);

            if($isPasswordCorrect){
                $_SESSION['email']  = $co['email'];
                $this->redirectTo('?page=profil');
            }
            else{
                $error_msg2 = "Mauvais identifiant ou mot de passe";
            } 
        }
        else{
            $error_msg2 = "Merci de remplir tous les champs";
        }
        include("views/view_signin.php");
    }

    public function profil(){
        if (!isset($_SESSION['email'])){
            $this->redirectTo('/w1php501p3/');
        }
        $yo = new Member();
        $infos = $yo->infoMember();
        
        if (isset($_POST['edit_name']) && isset($_POST['edit_firstname']) && isset($_POST['edit_pseudo']) && isset($_POST['edit_pseudo']) && isset($_POST['edit_date_naissance']) && isset($_POST['edit_city']) && isset($_POST['edit_email']) &&isset($_POST['edit_password'])
        &&!empty($_POST['edit_name']) && !empty($_POST['edit_firstname']) && !empty($_POST['edit_pseudo']) && !empty($_POST['edit_pseudo']) && !empty($_POST['edit_date_naissance']) && !empty($_POST['edit_city']) && !empty($_POST['edit_email']) && !empty($_POST['edit_password'])){
            $yo = new Member();
            $yo->editInfo();
        }
        else{
            $error_msg3 = "Merci de remplir tous les champs";
        }
        include("views/view_profil.php");
    }

    public function logout() {
        session_destroy();
        $this->redirectTo('/w1php501p3/');
    }
}
