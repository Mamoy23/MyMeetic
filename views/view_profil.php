<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="views/main.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Thasadith" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="linear-gradient">
    <header>
        
        </header>
        
        <div class="d-flex justify-content-center align-items-center">
            <img src="heart.png" id="logo">
            <h1 class="text-white text-center m-2">Bienvenue <?= $infos['pseudo']?> !</h1>
        </div>
        
        <div class="m-4 rounded block-background text-center">
            <h2>Mon profil</h2>
            <h3>Je m'appelle</h3><p class="font-weight-bold"><?= $infos['nom']." ".$infos['prenom']?></p>
            <h3>Plus connu sous le nom de</h3><p class="font-weight-bold"><?= $infos['pseudo']?></p>
            <h3>Je suis né(e) le</h3><p class="font-weight-bold"><?= $infos['date_naissance'][2]."/".$infos['date_naissance'][1]."/".$infos['date_naissance'][0]?></p>
            <h3>J'habite à</h3><p class="font-weight-bold"><?= $infos['ville']?></p>
            <h3>Mon email</h3><p class="font-weight-bold"><?= $infos['email'] ?></p>  
            
            <button type="button" id="update_button" class="submit-button border-0 text-white font-weight-bold">Modifier mon profil</button>
            <button type="button" id="update_id_button" class="submit-button border-0 text-white font-weight-bold">Modifier mon mot de passe</button>
            <button type="button" id="delete_button" class="submit-button border-0 text-white font-weight-bold">Supprimer mon compte</button>
            
            <form action="?page=profil" method="POST" id="update_form" class="text-center m-2">
                <input type="hidden" name="send">
                <input type="text" name="edit_name" placeholder="Nom" value="<?= $infos['nom']?>" class="input">
                <input type="text" name="edit_firstname" placeholder="Prénom" value="<?= $infos['prenom']?>" class="input">
                <input type="text" name="edit_pseudo" placeholder="Pseudo" value="<?= $infos['pseudo']?>" class="input">
                
                <p class="m-0">Date de naissance :</p>
                <div class="d-flex align-items-baseline select">
                    <select name="edit_birthday" id="birthday" class="m-1 sub-select">
                        <option value="<?=$infos['date_naissance'][2]?>"><?=$infos['date_naissance'][2]?></option>
                        <?php for($day = 1; $day <= 31; $day++) :?>
                        <option value="<?=$day?>"><?=$day?></option>
                        <?php endfor;?>
                    </select>
                    
                    <select name="edit_birthmonth" id="birthmonth" class="m-1 sub-select">
                        <option value="<?=$infos['date_naissance'][1]?>"><?= ucfirst(strftime('%B', mktime(0, 0, 0, $infos['date_naissance'][1], 1)))?></option>
                        <?php $month_tab = array(1=>'Janvier', 2=>'Février', 3=>'Mars', 4=>'Avril', 5=>'Mai', 6=>'Juin', 7=>'Juillet', 8=>'Aout', 9=>'Septembre', 10=>'Octobre', 11=>'Novembre', 12=>'Decembre');
                    foreach($month_tab as $key => $month) :?>
                    <option value="<?=$key?>"><?=$month?></option>
                    <?php endforeach;?>
                </select>
                
                <select name="edit_birthyear" id="birthyear" class="m-1 sub-select">
                    <option value="<?=$infos['date_naissance'][0]?>"><?=$infos['date_naissance'][0]?></option>
                    <?php for($year= 2019; $year >= 1918; $year--) :?>
                    <option value="<?=$year?>"><?=$year?></option>
                    <?php endfor;?>
                </select>

            </div>
            
            <input type="text" name="edit_city" placeholder="Ville" value="<?= $infos['ville']?>" class="input">
            <input type="email" name="edit_email" placeholder="Email" value="<?= $infos['email']?>" class="input">
            
            <button type="submit" class="submit-button text-white border-0 font-weight-bold">Sauvegarder</button>
        </form>
        <?php if(isset($error_msg3)): ?>
        <p class="alert alert-light m-3"><?= $error_msg3?><p>
            <?php endif; ?>
            
            <form action="?page=profil" method="POST" id="update_id_form" class="text-center m-2">
                <input type="hidden" name="check">
                <input type="password" name="edit_password" placeholder="Mot de passe actuel" class="input">
                <input type="password" name="new_password" placeholder="Nouveau mot de passe" class="input">
                <input type="password" name="new_password2" placeholder="Confirmation mot de passe" class="input">
                <button type="submit" class="submit-button text-white border-0 font-weight-bold">Sauvegarder</button>
            </form>
            <?php if(isset($error_msg4)): ?>
            <p class="alert alert-light m-3"><?= $error_msg4?><p>
                <?php endif; ?>
            </div>
            <script src="controllers/hide_form.js"></script>
            <script src="controllers/delete_member.js"></script>
        </body>
        </html>