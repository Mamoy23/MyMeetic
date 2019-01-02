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
    <script src="controllers/hide_form.js"></script>
</head>
<body class="linear-gradient">
    <header>
        
        </header>
        
        <div class="d-flex justify-content-center align-items-center">
            <img src="heart.png" id="logo">
            <h1 class="text-white text-center m-2">Bienvenue <?= $infos['pseudo']?> !</h1>
        </div>
        
        <div class="block-background">
            <h2>Mon profil</h2>
            <table class="table table-striped">
                <tr>
                    <td><?= $infos['nom']?></td>
                    <td><?= $infos['prenom']?></td>
                </tr>
                <tr>
                    <td>Pseudo : <?= $infos['pseudo'] ?></td>
                    <td>Né(e) le <?= $infos['date_naissance']?></td>
                </tr>
                <tr>
                    <td>Genre : <?= $infos['sexe'] ?></td>
                    <td>De : <?= $infos['ville'] ?></td>
                </tr>
                <tr>
                    <td><?= $infos['email'] ?></td>
                    <td>Mot de passe : </td>
                </tr>
            </table>
            
            <button type="button" id="update_button" class="submit-button border-0 text-white font-weight-bold">Modifier mon profil</button>
            
            <form action="?page=profil" method="POST" id="update_form">
                
                <input type="text" name="edit_name" value="<?= $infos['nom']?>" class="input">
                <input type="text" name="edit_firstname" value="<?= $infos['prenom']?>" class="input">
                <input type="text" name="edit_pseudo" value="<?= $infos['pseudo']?>" class="input">
                
                <p class="m-0">Date de naissance :</p>
                <input type="date" name="edit_date_naissance" value="<?= $infos['date_naissance']?>">
                
                <input type="text" name="edit_city" value="<?= $infos['ville']?>" class="input">
                <input type="email" name="edit_email" value="<?= $infos['email']?>" class="input">
                
                <input type="password" name="edit_password" value="" class="input">
                
                <?php if(isset($error_msg3)): ?>
                <p class="alert alert-light m-3"><?= $error_msg3?><p>
                    <?php endif; ?>

                <button type="submit" class="submit-button text-white border-0 m-3 font-weight-bold">Sauvegarder</button>
        </form>
    </div>
</body>
</html>