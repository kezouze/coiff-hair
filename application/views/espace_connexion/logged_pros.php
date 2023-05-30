<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connected (pro)</title>
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Bienvenue cher professionnel !</h1>
        <h2>Voici la liste de vos rendez-vous du jour :</h2>
        <ul>
        <?php 
            foreach($all_data as $key) { ?>
                <li>Mme/Mr <?= $key->id_user?> à <?= $key->heure_rendez_vous?> <br>détails : <?= $key->details_rendez_vous?></li>
        <?php
            }
        ?>
        </ul>
    </div>
</body>
</html>
