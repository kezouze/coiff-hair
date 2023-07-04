<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connected</title>
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
</head>

<body>
    <div class="container">
        <h3>Bienvenue <?= '<b>' . ucfirst($_SESSION['pseudo']) . '</b>,' ?> sur votre espace personnel !</h3>
        <?php if (count($all_rdv) == 0) { ?>
            <p>Vous n'avez pas de rendez-vous pour le moment</p>
        <?php } else { ?>
            <p>Vous avez <?= (count($all_rdv)) ?> rendez-vous à venir :</p>
            <ul>
                <?php foreach ($all_rdv as $rdv) { ?>
                    <div class="ligne">
                        <li><i>Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H:i', strtotime($rdv->heure_rendez_vous)) . '.</i><br>Détails : ' . $rdv->details_rendez_vous ?></li>
                        <a href="/code_igniter_arthur/Users/modify_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img src="/code_igniter_arthur/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                        <a href="/code_igniter_arthur/Users/delete_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img class="icone_suppr" src="/code_igniter_arthur/assets/images/supprimer.png" alt="icone_supprimer"></a>
                    </div>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php if ((count($all_rdv)) < 3) { ?>
            <a href="/code_igniter_arthur/Users/rendez_vous">Prendre un rendez-vous</a>
        <?php } else { ?>
            <p>Vous avez atteint le nombre maximum de rendez-vous.</p>
        <?php } ?>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
</body>

</html>