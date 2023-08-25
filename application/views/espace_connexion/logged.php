<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre Espace";
$color = "#0964cc";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php') ?>
        <div class="content">
            <h3>Bonjour <?= '<b style="color:' . $color . '; font-size:30px;">' . ucfirst($first_name) . '</b>' . ' !' ?></h3>
            <?php if (count($next_rdv) == 0) { ?>
                <p>Vous n'avez pas de rendez-vous à venir</p>
            <?php } else { ?>
                <p>Vous avez <span style="font-size:2rem;color:<?= $color ?>"><?= (count($next_rdv)) ?></span> rendez-vous à venir :</p>
                <ul>
                    <?php foreach ($next_rdv as $rdv) {
                        if ($rdv->date_rendez_vous >= date('Y-m-d')) { ?>
                            <div class="ligne">
                                <div class="li">
                                    <li><i class="dateAndTime">Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H\hi', strtotime($rdv->heure_rendez_vous)) . '.</i>
                        <br><span>Détails : ' . $rdv->details_rendez_vous ?>.</span></li>
                                </div>
                                <div class="icones_container">
                                    <a href="/coiffhair/Users/modify_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img src="/coiffhair/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                                    <a href="/coiffhair/Users/delete_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img class="icone_suppr" src="/coiffhair/assets/images/supprimer.png" alt="supprimer"></a>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </ul>
            <?php } ?>
            <?php if ((count($next_rdv)) < 1) { ?>
                <a class="button" href="/coiffhair/Users/rendez_vous">Prendre un rendez-vous</a>
            <?php } else if (count($next_rdv) >= 1 && count($next_rdv) < 3) { ?>
                <a class="button" href="/coiffhair/Users/rendez_vous">Prendre un autre rendez-vous</a>
            <?php } else { ?>
                <p class="error">Vous avez atteint le nombre maximum de rendez-vous.</p>
            <?php } ?>
            <?php if ((count($old_rdv)) > 0) { ?>
                <hr>
                <a style="background-color:white; color:<?= $color ?>" class="toggleButton button" id="toggleButton">Voir mes rendez-vous passés</a>
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
                    <a style="color:#ff033e" href="/coiffhair/Users/delete_old_rdv">Supprimer les rdv passés</a>
                </div>
            <?php } ?>
            <a style="color:#ff033e" href="/coiffhair/Users/deconnect">Se déconnecter</a>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php') ?>

    </div>
</body>
<script>
    toggleButton();
</script>

</html>