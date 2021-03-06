<?php

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
        $stmt->bindValue('nom', trim($_POST['name']), PDO::PARAM_STR);
        $stmt->bindValue('prenom', trim($_POST['firstname']), PDO::PARAM_STR);
        $stmt->bindValue('pseudo', trim($_POST['pseudo']), PDO::PARAM_STR);
        $stmt->bindValue('date_naissance', $_POST['birthyear']."-".$_POST['birthmonth']."-".$_POST['birthday'], PDO::PARAM_STR);
        $stmt->bindValue('sexe', $_POST['gender'], PDO::PARAM_STR);
        $stmt->bindValue('ville', trim($_POST['city']), PDO::PARAM_STR);
        $stmt->bindValue('email', trim($_POST['email']), PDO::PARAM_STR);
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
        $stmt->bindValue('nom', htmlspecialchars(trim($_POST['edit_name'])), PDO::PARAM_STR);
        $stmt->bindValue('prenom', htmlspecialchars(trim($_POST['edit_firstname'])), PDO::PARAM_STR);
        $stmt->bindValue('pseudo', htmlspecialchars(trim($_POST['edit_pseudo'])), PDO::PARAM_STR);
        $stmt->bindValue('date', $_POST['edit_birthyear']."-".$_POST['edit_birthmonth']."-".$_POST['edit_birthday'], PDO::PARAM_STR);
        $stmt->bindValue('ville', htmlspecialchars(trim($_POST['edit_city'])), PDO::PARAM_STR);
        $stmt->bindValue('email', htmlspecialchars(trim($_POST['edit_email'])), PDO::PARAM_STR );
        $stmt->bindValue('session', $_SESSION['id_membre'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->errorCode();
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

    public function searchLove(){
        $search = "SELECT * FROM membres WHERE 1";
        if(isset($_POST['city']) && !empty($_POST['city'])){
            $search .= " AND ville IN (";
            $i = 0;
            foreach($_POST['city'] as $city){
                if($i == 0){
                    $search .= "'{$city}'";
                }
                else{
                    $search .= ", '{$city}'";
                }
                $i++;
            }
            $search .= ")";
        }
        if(isset($_POST['genre']) && !empty($_POST['genre'])){
            $search .= " AND sexe ='{$_POST['genre']}'";
        }
        if(isset($_POST['age']) && !empty($_POST['age'])){
            $i = 0;
            foreach($_POST['age'] as $age){
                if($i == 0){
                    $search .= " AND ((TIMESTAMPDIFF(YEAR, date_naissance, DATE(NOW()))";
                }
                else{
                    $search .= " OR (TIMESTAMPDIFF(YEAR, date_naissance, DATE(NOW()))";
                }
                if($age == "18/25"){
                    $search .= " BETWEEN 18 AND 25)";
                }
                if($age == "25/35"){
                    $search .= " BETWEEN 25 AND 35)";
                }
                if($age == "35/45"){
                    $search .= " BETWEEN 35 AND 45)";
                }
                if($age == "45+"){
                    $search .= " >= 45)";
                }
                $i++;
            }
            $search .= ")";
        }
        $stmt = $this->bdd->prepare($search);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

class Tchat{
    private $bdd;

    public function __construct(){
        try
        {
        $this->bdd = new PDO('mysql:host=localhost;dbname=my_meetic;host=127.0.0.1;charset=utf8', 'root', 'root');
        } catch (Exception $e) {
        var_dump($e);
        }
    }

    public function msg(){
        $query = "INSERT INTO messages(contenu, date_msg, id_exp, id_dest) VALUES (:contenu, NOW(), :id_exp, :id_dest)";
        $stmt = $this->bdd->prepare($query);
        
    }
}