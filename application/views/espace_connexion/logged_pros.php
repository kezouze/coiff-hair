<!DOCTYPE html>
<html lang="fr">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <?php if (count($all_rdv) < 1) { ?>
                <h2>Vous n'avez pas de rendez-vous aujourd'hui.</h2>
            <?php } else { ?>
                <h2>Vos rendez-vous du <?= date('d/m/y'); ?> </h2>
                <ul>
                    <?php
                    foreach ($all_rdv as $key) { ?>
                        <div class="ligne">
                            <div class="li">
                                <li><span class="first_line"><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> - <?= ucfirst($key->last_name) . ' ' . ucfirst($key->first_name) ?></span>
                                    <button style="background:white; padding:0 5px;" onclick="openPopUp(<?= $key->id_rendez_vous ?>)"><i style="color:<?= $color ?>;">Détails</i></button>
                                    <div id="pop-up-<?= $key->id_rendez_vous ?>" class="pop-up">
                                        <span class="first_line"><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> - <?= ucfirst($key->last_name) . ' ' . ucfirst($key->first_name) ?></span>
                                        <div class="details">
                                            <p><?= $key->details_rendez_vous ?></p>
                                        </div>
                                        <button class="exit-btn" onclick="closePopUp(<?= $key->id_rendez_vous ?>)">✖</button>
                                    </div>
                                </li>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                </ul>
                <hr>
                <a href="http://[::1]/coiffhair/Pros/printPdf" class="button" style="background:<?= $color ?>">Imprimer</a>
                <a href="http://[::1]/coiffhair/Pros/updateInfos" class="button" style="background:<?= $color ?>">Mettez à jour vos infos</a>
                <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $_SESSION['id'] ?>" class="button" style="background:<?= $color ?>">Voir votre page</a>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>
<script>
    <?php foreach ($all_rdv as $key) { ?>
        var popUp<?= $key->id_rendez_vous ?> = document.getElementById('pop-up-<?= $key->id_rendez_vous ?>');
    <?php } ?>

    function openPopUp(rdvId) {
        var popUp = document.getElementById('pop-up-' + rdvId);
        popUp.style.display = "flex";
    }

    function closePopUp(rdvId) {
        var popUp = document.getElementById('pop-up-' + rdvId);
        popUp.style.display = "none";
    }
</script>

</html>