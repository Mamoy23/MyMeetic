<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TrueLove</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="views/main.css">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Thasadith" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="linear-gradient">
    <header>
    <img src="menu.png" id="menu" alt="menu">
        <?php include("view_menu.html")?>
        <h1 class="text-white text-center m-2">Trouver l'amour !</h1>
            <div class="text-center">
                <img src="heart.png" id="logo">
            </div>
    </header>

    <div class="block-background">

    <form action="?page=meetic" method="POST" class="text-center">
        <p class="m-0">Genre :</p>
            <input type="radio" id="man" name="genre" value="homme" class="m-2">
            <label for="man">Homme</label> 
            <input type="radio" id="woman" name="genre" value="femme" class="m-2">
            <label for="woman">Femme</label>
            <input type="radio" id="other" name="genre" value="autre" class="m-2">
            <label for="other">Autre</label>

        <p class="m-0">Age :</p>
        <div>
            <input type="checkbox" value="18/25" name="age" class="m-2">
            <label for="18/25">18-25 ans</label>
            <input type="checkbox" value="25/35" name="age" class="m-2">
            <label for="25/35">25-35 ans</label><br />
            <input type="checkbox" value="35/45" name="age" class="m-2">
            <label for="35/45">35-45 ans</label>
            <input type="checkbox" value="45+" name="age" class="m-2">
            <label for="45+">45 ans et plus</label>
        </div>

        <p class="m-0">Localisation :</p>
        <select name="city" multiple size=5>
        <?php $city_tab = array_unique($city_tab);
        foreach($city_tab as $city):?>
        <option><?= $city?></option>
        <?php endforeach;?>

        <input type="submit" value="Rechercher">
    </form>
    </div>
    <?php if(isset($_POST['city'])):
    foreach($result as $res):?>
    <p><?= $res['prenom']?></p>
    <?php endforeach;
    endif;
    if(isset($error_msg5)): ?>
        <p class="alert alert-light m-3"><?= $error_msg5?><p>
    <?php endif; ?>
    <script src="controllers/hide_element.js"></script>
</body>
</html>