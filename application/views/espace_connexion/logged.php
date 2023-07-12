<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php if ($gender == 'M') { ?>
            <h3>Bienvenue <?= '<b style="color:blue; font-size:25px;">' . ucfirst($first_name) . '</b>,' ?> sur votre espace personnel !</h3>
        <?php } else { ?>
            <h3>Bienvenue <?= '<b style="color:hotpink; font-size:25px">' . ucfirst($first_name) . '</b>,' ?> sur votre espace personnel !</h3>
        <?php } ?>
        <?php if (count($all_rdv) == 0) { ?>
            <p>Vous n'avez pas de rendez-vous pour le moment</p>
        <?php } else { ?>
            <p>Vous avez <?= (count($all_rdv)) ?> rendez-vous à venir :</p>
            <ul>
                <?php foreach ($all_rdv as $rdv) { ?>
                    <div class="ligne">
                        <div class="li">
                            <li><i>Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H:i', strtotime($rdv->heure_rendez_vous)) . '.</i>
                        <br><span>Détails : ' . $rdv->details_rendez_vous ?></span></li>
                        </div>
                        <div class="icones_container">
                            <a href="/code_igniter_arthur/Users/modify_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img src="/code_igniter_arthur/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                            <a href="/code_igniter_arthur/Users/delete_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img class="icone_suppr" src="/code_igniter_arthur/assets/images/supprimer.png" alt="supprimer"></a>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php if ((count($all_rdv)) < 1) { ?>
            <a href="/code_igniter_arthur/Users/rendez_vous">Prendre un rendez-vous</a>
        <?php } else if (count($all_rdv) >= 1 && count($all_rdv) < 3) { ?>
            <a href="/code_igniter_arthur/Users/rendez_vous">Prendre un autre rendez-vous</a>
        <?php } else { ?>
            <p class="error">Vous avez atteint le nombre maximum de rendez-vous.</p>
        <?php } ?>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
</body>

</html>