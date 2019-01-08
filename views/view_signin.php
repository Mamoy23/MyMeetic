<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TrueLove</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="views/main.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Thasadith" rel="stylesheet">
</head>

<body class="linear-gradient">
    <header>
        <h1 class="text-white text-center m-2">TrueLove</h1>
        <div class="text-center">
            <img src="heart.png" id="logo">
        </div>
    </header>

    <div class="m-4 rounded block-background">
        <h2 class="text-center">Rejoignez nous, c'est gratuit !</h2>

        <form action="?page=signin" method="POST" class="text-center">
    
            <input type="text" name="name" placeholder="Nom" class="input">
            <input type="text" name="firstname" placeholder="Prénom" class="input">
            <input type="text" name="pseudo" placeholder="Pseudo" class="input">

            <p class="m-0">Date de naissance :</p>
            <div class="d-flex align-items-baseline select">
                <select name="birthday" id="birthday" class="m-1 sub-select">
                    <option value="day">Jour</option>
                    <?php for($day = 1; $day <= 31; $day++) :?>
                        <option value="<?=$day?>"><?=$day?></option>
                    <?php endfor;?>
                </select>

                <select name="birthmonth" id="birthmonth" class="m-1 sub-select">
                    <option value="month">Mois</option>
                    <?php $month_tab = array(1=>'Janvier', 2=>'Février', 3=>'Mars', 4=>'Avril', 5=>'Mai', 6=>'Juin', 7=>'Juillet', 8=>'Aout', 9=>'Septembre', 10=>'Octobre', 11=>'Novembre', 12=>'Decembre');
                    foreach($month_tab as $key => $month) :?>
                    <option value="<?=$key?>"><?=$month?></option>
                    <?php endforeach;?>
                </select>

                <select name="birthyear" id="birthyear" class="m-1 sub-select">
                    <option value="year">Année</option>
                    <?php for($year= 2019; $year >= 1918; $year--) :?>
                        <option value="<?=$year?>"><?=$year?></option>
                    <?php endfor;?>
                </select>
            </div>

            <p class="m-0">Genre :</p>
            <div class="d-flex align-items-baseline select">
                <input type="radio" id="man" name="gender" value="homme" class="m-2">
                <label for="man">Homme</label> 
                <input type="radio" id="woman" name="gender" value="femme" class="m-2">
                <label for="woman">Femme</label>
                <input type="radio" id="other" name="gender" value="autre" class="m-2">
                <label for="other">Autre</label>
            </div>

            <input type="text" name="city" placeholder="Ville" class="input">
            <input type="email" name="email" placeholder="Email" class="input">

            <input type="password" name="password" placeholder="Mot de passe" class="input">

            <input type="password" name="verif_password" placeholder="Confirmation mot de passe" class="input">

            <?php if(isset($error_msg)): ?>
            <p class="alert alert-light m-3"><?= $error_msg?><p>
            <?php endif; ?>

            <button type="submit" class="submit-button text-white border-0 font-weight-bold">Valider</button>
        </form>
    </div>

    <div class="m-4 rounded block-background">
        <h2 class="text-center">Content de vous revoir !</h2>

       <form action="?page=login" method="POST" class="text-center">
            <input type="email" name="co_email" placeholder="Email" class="input">
            <input type="password" name="co_password" placeholder="Mot de passe" class="input">
            <?php if(isset($error_msg2)): ?>
            <p class="alert alert-light m-3"><?= $error_msg2?></p>
            <?php endif; ?>
            <button type="submit" class="submit-button text-white border-0 font-weight-bold">Se connecter</button>
       </form>
    </div>

    <footer>
    </footer>
</body>
</html>