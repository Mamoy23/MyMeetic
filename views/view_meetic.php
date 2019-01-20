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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="linear-gradient">
    <header>
        <img src="images/menu.png" id="menu" alt="menu">
        <?php include("view_menu.html")?>
        <h1 class="text-white text-center m-2">Trouver l'amour !</h1>
            <div class="text-center">
                <img src="images/heart.png" id="logo" alt="heart">
            </div>
    </header>

    <div class="block-background-profil rounded d-flex justify-content-center">

    <form action="?page=meetic" id="meetic_form" method="POST" class="text-center">
        <h3 class="m-0 font-weight-bold">Genre :</h3>
            <input type="radio" id="man" name="genre" value="homme" class="m-2">
            <label for="man">Homme</label> 
            <input type="radio" id="woman" name="genre" value="femme" class="m-2">
            <label for="woman">Femme</label>
            <input type="radio" id="other" name="genre" value="autre" class="m-2">
            <label for="other">Autre</label>

        <h3 class="m-0 font-weight-bold">Age :</h3>
        <div>
            <input type="checkbox" id="18/25" value="18/25" name="age[]" class="m-2">
            <label for="18/25">18-25 ans</label>
            <input type="checkbox" id="25/35" value="25/35" name="age[]" class="m-2">
            <label for="25/35">25-35 ans</label><br />
            <input type="checkbox" id="35/45" value="35/45" name="age[]" class="m-2">
            <label for="35/45">35-45 ans</label>
            <input type="checkbox" id="45+" value="45+" name="age[]" class="m-2">
            <label for="45+">45 ans et plus</label>
        </div>

        <h3 class="m-0 font-weight-bold">Localisation :</h3>
        <select name="city[]" multiple size=5 class="select-loc">
            <?php $city_tab = array_unique($city_tab);
            foreach($city_tab as $city):?>
            <option value="<?=$city?>"><?= ucfirst(strtolower($city))?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" value="Rechercher" class="submit-button border-0 font-weight-bold">
    </form>
    </div>
    
    <div id="galerie" class="m-4 rounded">
        <div class="slider d-flex">
        </div>
        <div class="suiv"></div>
        <div class="prec"></div> 
    </div>

    <script src="controllers/hide_element.js"></script>
    <script src="controllers/slider.js "></script>
    <script src="controllers/ajax.js"></script>
</body>
</html>