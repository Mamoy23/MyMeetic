<?php
require_once('controller.php');
require_once('../models/model.php');

if (isset($_POST['city']) || isset($_POST['genre']) || isset($_POST['age']) || !empty($_POST['city']) || !empty($_POST['genre']) || !empty($_POST['age'])){
    $yo = new Meetic();
    $result = $yo->searchLove();
}
?>
     <?php foreach($result as $res):?>
            <ul class="list-unstyled rounded m-2 p-2">
                <li><h5 class="font-weight-bold"><?= ucfirst(strtolower($res['nom'])." ".ucfirst(strtolower($res['prenom'])))?></h5></li>
                <li>Surommé <?=ucfirst(strtolower($res['pseudo']))?></li>
                <li>Né(e) le <?=$res['date_naissance']?></li>
                <li>Vit à <?=ucfirst(strtolower($res['ville']))?></li>
                <li>Sexe <?=ucfirst(strtolower($res['sexe']))?></li>
                <li><?=ucfirst(strtolower($res['email']))?></li>
            </ul>
            <?php endforeach;?>