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
            foreach ($all_rdv as $key) { ?>
                <div class="ligne">
                    <li><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> : Mme/Mr <?= $key->last_name . ' ' . $key->first_name ?>
                        <br>détails : <?= $key->details_rendez_vous ?>
                    </li>
                </div>
            <?php
            }
            ?>
        </ul>
        <a style="color:red" href="/code_igniter_arthur/Pros/deconnect">Se déconnecter</a>
    </div>
</body>

</html>