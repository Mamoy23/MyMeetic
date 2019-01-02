<?php
//modèle(requêtes SQL : récupération des données puis les envoie à index)
    
    class Member{

        private $bdd;

        public function __construct(){
            try
            {
            $this->bdd = new PDO('mysql:host=localhost;dbname=my_meetic;host=127.0.0.1;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
            var_dump($e);
            }
        }

        public function addMember(){
            $add_member = "INSERT INTO membres(nom, prenom, pseudo, date_naissance, sexe, ville, email, mdp) VALUES(:nom, :prenom, :pseudo, :date_naissance, :sexe, :ville, :email, :mdp)";
            $stmt = $this->bdd->prepare($add_member);
            $stmt->bindValue('nom', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['firstname'], PDO::PARAM_STR);
            $stmt->bindValue('pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $stmt->bindValue('date_naissance', $_POST['birthyear']."-".$_POST['birthmonth']."-".$_POST['birthday'], PDO::PARAM_STR);
            $stmt->bindValue('sexe', $_POST['gender'], PDO::PARAM_STR);
            $stmt->bindValue('ville', $_POST['city'], PDO::PARAM_STR);
            $stmt->bindValue('email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindValue('mdp', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->errorCode();
        }

        public function coMember(){
            $co_member = "SELECT * FROM membres WHERE email = :email";
            $stmt = $this->bdd->prepare($co_member);
            $stmt->bindValue('email', $_POST['co_email'], PDO::PARAM_STR);
            $stmt->execute();
            $co = $stmt->fetch(PDO::FETCH_ASSOC);
            return $co;
        }

        public function infoMember(){
            $info_member = "SELECT * from membres WHERE email = :email";
            $stmt = $this->bdd->prepare($info_member);
            $stmt->bindValue('email', $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();
            $infos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $infos;
        }

        public function editInfo(){
            $edit_info = "UPDATE membres SET nom = :nom, prenom = :prenom, pseudo = :pseudo, date_naissance = :date, ville = :ville, email = :email, mdp = :mdp WHERE email = :session";
            $stmt = $this->bdd->prepare($edit_info);
            $stmt->bindValue('nom', $_POST['edit_name'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['edit_firstname'], PDO::PARAM_STR);
            $stmt->bindValue('pseudo', $_POST['edit_pseudo'], PDO::PARAM_STR);
            $stmt->bindValue('date', $_POST['edit_date_naissance'], PDO::PARAM_STR);
            $stmt->bindValue('ville', $_POST['edit_city'], PDO::PARAM_STR);
            $stmt->bindValue('email', $_POST['edit_email'], PDO::PARAM_STR );
            $stmt->bindValue('mdp', password_hash($_POST['edit_password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindValue('session', $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }
