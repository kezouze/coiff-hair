<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace";
require_once(APPPATH . 'views/includes/head.php');
if ($gender == 'M') {
    $color = "#00c8ff";
} else if ($gender == 'F') {
    $color = "#ff69b4";
} else {
    $color = "#3cd070";
}
?>

<body>
    <div class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php');
        $test = 1; ?>
        <h3>Bonjour <?= '<b style="color:' . $color . '; font-size:30px;">' . ucfirst($first_name) . '</b>' . ' !' ?></h3>
        <?php if (count($next_rdv) == 0) { ?>
            <p>Vous n'avez pas de rendez-vous à venir</p>
        <?php } else { ?>
            <p>Vous avez <?= (count($next_rdv)) ?> rendez-vous à venir :</p>
            <ul>
                <?php foreach ($next_rdv as $rdv) {
                    if ($rdv->date_rendez_vous >= date('Y-m-d')) { ?>
                        <div class="ligne">
                            <div class="li">
                                <li><i class="dateAndTime">Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H\hi', strtotime($rdv->heure_rendez_vous)) . '.</i>
                        <br><span>Détails : ' . $rdv->details_rendez_vous ?>.</span></li>
                            </div>
                            <div class="icones_container">
                                <a href="/code_igniter_arthur/Users/modify_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img src="/code_igniter_arthur/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                                <a href="/code_igniter_arthur/Users/delete_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img class="icone_suppr" src="/code_igniter_arthur/assets/images/supprimer.png" alt="supprimer"></a>
                            </div>
                        </div>
                <?php }
                } ?>
            </ul>
        <?php } ?>
        <?php if ((count($next_rdv)) < 1) { ?>
            <a class="rdvButton" style="color:white; background-color:<?= $color ?>;" href="/code_igniter_arthur/Users/rendez_vous">Prendre un rendez-vous</a>
        <?php } else if (count($next_rdv) >= 1 && count($next_rdv) < 3) { ?>
            <a class="rdvButton" style="color:white; background-color:<?= $color ?>;" href="/code_igniter_arthur/Users/rendez_vous">Prendre un autre rendez-vous</a>
        <?php } else { ?>
            <p class="error">Vous avez atteint le nombre maximum de rendez-vous.</p>
        <?php } ?>
        <?php if ((count($old_rdv)) > 0) { ?>
            <button style="background-color:white; color:<?= $color ?>" class="toggleButton" id="toggleButton">Voir mes rendez-vous passés</button>
            <div class="ligne2" style="display:none;">
                <ul>
                    <?php
                    // Trier les rendez-vous par ordre décroissant
                    usort($old_rdv, function ($a, $b) {
                        return strtotime($b->date_rendez_vous . ' ' . $b->heure_rendez_vous) - strtotime($a->date_rendez_vous . ' ' . $a->heure_rendez_vous);
                    });

                    foreach ($old_rdv as $rdv) { ?>
                        <div class="li">
                            <li><i>Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H\hi', strtotime($rdv->heure_rendez_vous)) ?>.</i>
                                <br><span>Détails : <?= $rdv->details_rendez_vous ?>.</span>
                            </li>
                        </div>
                    <?php } ?>
                </ul>
                <a style="color:#ff033e" href="/code_igniter_arthur/Users/delete_old_rdv">Supprimer les rdv passés</a>
            </div>
        <?php } ?>
        <a style="color:#ff033e" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
</body>
<script>
    toggleButton();
</script>

</html>