<?php

class Controller{

    private $_member;
    private $_meetic;

    public function __construct(){
        $this->_member = new Member();
        $this->_meetic = new Meetic();
    }

    public function redirectTo($url){
        header("Location: $url");
        exit;
    }

    public function formateDate(&$date){
        $date = explode("-", $date);
    }

    public function signin(){

        if (isset($_POST['name']) && isset($_POST['firstname']) &&isset($_POST['pseudo']) && isset($_POST['birthday']) && isset($_POST['birthmonth']) && isset($_POST['birthyear']) && isset($_POST['gender']) && isset($_POST['city']) && isset($_POST['email']) && isset($_POST['password']) &&isset($_POST['verif_password'])
        && !empty($_POST['name']) && !empty($_POST['firstname']) &&!empty($_POST['pseudo']) && !empty($_POST['birthday']) && !empty($_POST['birthmonth']) && !empty($_POST['birthyear']) && !empty($_POST['gender']) && !empty($_POST['city']) && !empty($_POST['email']) && !empty($_POST['password']) &&!empty($_POST['verif_password'])){
            if(ctype_alpha(str_replace(' ', '', $_POST['name'])) && ctype_alpha(str_replace(' ', '', $_POST['firstname'])) && ctype_alpha(str_replace(' ', '', $_POST['city']))){
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    if($_POST['birthyear'] <= 2001){
                        if($_POST['password'] === $_POST['verif_password']){
                            if($this->_member->addMember() == "23000"){
                                $error_msg = "Cette adresse mail est déjà utilisée!";
                            }
                            $co = $this->_member->coMember($_POST['email']);
                            $_SESSION['id_membre'] = $co['id_membre'];
                            $this->redirectTo('?page=profil');
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
                    $error_msg = "Merci de saisir une adresse email correcte";
                }
            }
            else{
                $error_msg = "Merci de saisir des données correctes";
            } 
        }
        else{
            $error_msg = "Merci de remplir tous les champs";
        }
        include("views/view_signin.php");
    }

    public function login(){
        if (isset($_POST['co_email']) && isset($_POST['co_password']) &&!empty($_POST['co_email']) && !empty($_POST['co_password'])){
            $co = $this->_member->coMember($_POST['co_email']);
            $isPasswordCorrect = password_verify($_POST['co_password'], $co['mdp']);

            if($isPasswordCorrect){
                $_SESSION['id_membre'] = $co['id_membre'];
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
        if (!isset($_SESSION['id_membre'])){
            $this->redirectTo('/w1php501p3/');
        }
        $yo = $this->_member;
        $infos = $yo->infoMember();
        if(isset($_POST['send'])){
            if (isset($_POST['edit_name']) && isset($_POST['edit_firstname']) && isset($_POST['edit_pseudo']) && isset($_POST['edit_pseudo']) && isset($_POST['edit_birthyear']) && isset($_POST['edit_birthmonth']) && isset($_POST['edit_birthday'])&& isset($_POST['edit_city']) && isset($_POST['edit_email'])
            &&!empty($_POST['edit_name']) && !empty($_POST['edit_firstname']) && !empty($_POST['edit_pseudo']) && !empty($_POST['edit_pseudo']) && !empty($_POST['edit_birthyear']) && !empty($_POST['edit_birthmonth']) && !empty($_POST['edit_birthday']) && !empty($_POST['edit_city']) && !empty($_POST['edit_email'])){
                if(ctype_alpha(str_replace(' ', '', $_POST['edit_name'])) && ctype_alpha(str_replace(' ', '', $_POST['edit_firstname'])) && ctype_alpha(str_replace(' ', '', $_POST['edit_city']))){
                    if(filter_var($_POST['edit_email'], FILTER_VALIDATE_EMAIL)){
                        if($_POST['edit_birthyear'] <= 2001){
                            if($this->_member->editInfo() == "23000"){
                                $error_msg3 = "Cette adresse mail est déjà utilisée!";
                            }
                        }
                        else{
                            $error_msg3 = "Les mineurs sont interdis ici!";
                        }
                    }
                    else{
                        $error_msg3 = "Merci de saisir une adresse email correcte";
                    }
                }
                else{
                    $error_msg3 = "Merci de saisir des données correctes";
                }
            }
            else{
                $error_msg3 = "Merci de remplir tous les champs";
            }
        }
        if(isset($_POST['check'])){
            if(isset($_POST['edit_password']) && isset($_POST['new_password']) && isset($_POST['new_password2']) && !empty($_POST['edit_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password2'])){
                $isPasswordCorrect = password_verify($_POST['edit_password'], $infos['mdp']);
                $isNewPasswordCorrect = $_POST['new_password'] === $_POST['new_password2'];
                $isNewPasswordChange = password_verify($_POST['new_password2'], $infos['mdp']);
                if($isPasswordCorrect){
                    if($isNewPasswordCorrect){
                        if($isNewPasswordChange){
                            $error_msg4 = "Merci de saisir un mot de passe différent de l'ancien";
                        }
                        else{
                            $yo = $this->_member;
                            $yo->editPassword();
                            $error_msg4 = "Votre mot de passe a bien été modifié!";
                        }
                    }
                    else{
                        $error_msg4 = "Merci de vérifier vos saisies";
                    }
                }
                else{
                    $error_msg4 = "Mauvais mot de passe actuel";
                }
            }
            else{
                $error_msg4 = "Merci de remplir tous les champs";
            }
        }
        $yo = $this->_member;
        $infos = $yo->infoMember();
        $this->formateDate($infos['date_naissance']);
        include("views/view_profil.php");
    }

    public function logout(){
        session_destroy();
        $this->redirectTo('/w1php501p3/');
    }

    public function deleteMember(){
        $yo = $this->_member;
        $yo->deleteMember();
        $this->logout();
    }

    public function meetic(){
        $yo = $this->_meetic;
        $city_tab = $yo->getLoc();
        include("views/view_meetic.php");
    }

    public function tchat(){
        include("views/view_msg.php");
    }
}
