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
            $add_member = "INSERT INTO membres(nom, prenom, pseudo, date_naissance, sexe, ville, email, mdp, statut) VALUES(:nom, :prenom, :pseudo, :date_naissance, :sexe, :ville, :email, :mdp, 1)";
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

        public function coMember($email){
            $co_member = "SELECT * FROM membres WHERE email = :email AND statut = 1";
            $stmt = $this->bdd->prepare($co_member);
            $stmt->bindValue('email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $co = $stmt->fetch(PDO::FETCH_ASSOC);
            return $co;
        }

        public function infoMember(){
            $info_member = "SELECT * from membres WHERE id_membre = :session AND statut = 1";
            $stmt = $this->bdd->prepare($info_member);
            $stmt->bindValue('session', $_SESSION['id_membre'], PDO::PARAM_STR);
            $stmt->execute();
            $infos = $stmt->fetch(PDO::FETCH_ASSOC);
            return $infos;
        }

        public function editInfo(){
            $edit_info = "UPDATE membres SET nom = :nom, prenom = :prenom, pseudo = :pseudo, date_naissance = :date, ville = :ville, email = :email WHERE id_membre = :session AND statut = 1";
            $stmt = $this->bdd->prepare($edit_info);
            $stmt->bindValue('nom', $_POST['edit_name'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['edit_firstname'], PDO::PARAM_STR);
            $stmt->bindValue('pseudo', $_POST['edit_pseudo'], PDO::PARAM_STR);
            $stmt->bindValue('date', $_POST['edit_birthyear']."-".$_POST['edit_birthmonth']."-".$_POST['edit_birthday'], PDO::PARAM_STR);
            $stmt->bindValue('ville', $_POST['edit_city'], PDO::PARAM_STR);
            $stmt->bindValue('email', $_POST['edit_email'], PDO::PARAM_STR );
            $stmt->bindValue('session', $_SESSION['id_membre'], PDO::PARAM_STR);
            $stmt->execute();
        }

        public function editPassword(){
            $edit_password = "UPDATE membres SET mdp = :mdp WHERE id_membre= :session AND statut = 1";
            $stmt = $this->bdd->prepare($edit_password);
            $stmt->bindValue('mdp', password_hash($_POST['new_password2'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->bindValue('session', $_SESSION['id_membre'], PDO::PARAM_STR);
            $stmt->execute();
        }

        public function deleteMember(){
            $delete_member = "UPDATE membres SET statut = 0 WHERE id_membre = :session AND statut = 1";
            $stmt = $this->bdd->prepare($delete_member);
            $stmt->bindValue('session', $_SESSION['id_membre'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    class Meetic{

        private $bdd;

        public function __construct(){
            try
            {
            $this->bdd = new PDO('mysql:host=localhost;dbname=my_meetic;host=127.0.0.1;charset=utf8', 'root', 'root');
            } catch (Exception $e) {
            var_dump($e);
            }
        }
        
        public function getLoc(){
           $stmt = $this->bdd->prepare("SELECT ville FROM membres");
           $stmt->execute();
           $city_tab = $stmt->fetchAll(PDO::FETCH_COLUMN);
           return $city_tab;
        }

        public function searchLoveby3(){
            $search = "SELECT * FROM membres WHERE ville =:ville AND sexe =:genre AND TIMESTAMPDIFF(YEAR, date_naissance, '2019-01-01')";
            if(($_POST['age']) == "18/25"){
                $search .= " BETWEEN 18 AND 25";
            }
            if(($_POST['age']) === "25/35"){
                $search .= " BETWEEN 25 AND 35";
            }
            if(($_POST['age']) === "35/45"){
                $search .= " BETWEEN 35 AND 45";
            }
            if(($_POST['age']) === "45+"){
                $search .= " >= 45 ";
            }
            
            $stmt = $this->bdd->prepare($search);
            $stmt->bindValue('ville', $_POST['city'], PDO::PARAM_STR);
            $stmt->bindValue('genre', $_POST['genre'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
