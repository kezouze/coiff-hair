<!DOCTYPE html>
<html lang="fr">

<?php
$dateYmd = $date;
$date = date('d-m-Y', strtotime($date));
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
$add_on = '<div class="pro-function-buttons">
<a href="http://[::1]/coiffhair/Pros/printPdf?date=' . $dateYmd . '" title="Imprimer planning du ' . $date . '" class="pro-button-header">🖨️</a>
<a href="http://[::1]/coiffhair/Pros/updateInfos" title="Modifier vos informations" class="pro-button-header">🖋️</a>
<a href="http://[::1]/coiffhair/Welcome/details?id=' . $_SESSION['id'] . '" title="Aperçu de votre page" class="pro-button-header">👀</a>
</div>';
?>

<body class="pro">
    <?php include(APPPATH . 'views/includes/header.php'); ?>
    <div class="blur" style="justify-content:start; padding: 0 0 4rem 0; min-height:88dvh">
        <div class="date-select">
            <h2>Rendez-vous du <?= $date ?></h2>
            <div class="previous-today-next-div">
                <a href="http://[::1]/coiffhair/Pros/logged?date=<?= $previous_day ?>">
                    <div>
                        <span class="pro-button">
                            <img class="previous" src="/coiffhair/assets/images/ciseaux.png" alt="">
                            Précédent
                        </span>
                    </div>
                </a>
                <a href="http://[::1]/coiffhair/Pros/logged?date=<?= $today ?>">
                    <div>
                        <span class="pro-button">
                            <img class="today" src="/coiffhair/assets/images/ciseaux.png" alt="">
                            Aujourd'hui
                        </span>
                    </div>
                </a>
                <a href="http://[::1]/coiffhair/Pros/logged?date=<?= $next_day ?>">
                    <div>
                        <span class="pro-button">
                            <img class="next" src="/coiffhair/assets/images/ciseaux.png" alt="">
                            Suivant
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <div class="content">
            <hr>
            <?php if (count($all_rdv) < 1) { ?>
                <h4>Aucun rendez-vous prévu</h4>
            <?php } ?>
            <ul>
                <?php
                foreach ($all_rdv as $key) {
                    if ($key->gender == "F") {
                        $key->gender = "Mme";
                    }
                    if ($key->gender == "M") {
                        $key->gender = "M.";
                    }
                ?>
                    <div class="ligne">
                        <div class="pro-li">
                            <li>
                                <p class="first_line"><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> - <?= $key->gender . ' ' . strtoupper($key->last_name) . ' ' . ucfirst($key->first_name) ?>
                                    <button style="background:white; padding:0 5px;" onclick="openPopUp(<?= $key->id_rendez_vous ?>)"><i style="color:<?= $color ?>;">Détails</i></button>
                                </p>
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
                ?>
            </ul>
        </div>
    </div>
    <div class="footer fixed-footer">
        <span style="width:33%">
            <a href="http://[::1]/coiffhair/<?= $linkTo ?>" class="retour-button" style="background-color:<?= $color ?>">Retour</a>
        </span>
        <span style="width:34%">
            <?php if (isConnected()) { ?>
                <a href="http://[::1]/coiffhair/Pros/deconnect" class="deco_button">Déconnexion</a>
            <?php } ?>
        </span>
        <span style="width:33%">
            <div class="isOnHolidays">
                <p>Mode vacances</p>
                <input data="<?= $isOnHolidays ?>" type="checkbox" id="holidays" name="holidays" <?= $isOnHolidays ? 'checked' : '' ?>>
            </div>
        </span>
    </div>
</body>
<script>
    isOnHolidays();
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