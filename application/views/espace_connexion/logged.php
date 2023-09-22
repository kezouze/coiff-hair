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
                <ul class="ul-rdv">
                    <?php foreach ($next_rdv as $rdv) {
                        $id_rdv = $rdv->id_rendez_vous;
                        if ($rdv->date_rendez_vous >= date('Y-m-d')) { ?>
                            <div class="ligne">
                                <div class="client-li">
                                    <li>
                                        <p class="dateAndTime">Le <?= date('d/m', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H\hi', strtotime($rdv->heure_rendez_vous)) ?><br>chez <a style="text-decoration:none;" href="/coiffhair/Welcome/details?id=<?= $rdv->id_pro ?>"><span class="salon"><?= $rdv->name ?></span></a></p>
                                        <h3 style="margin-top:1rem;">Votre demande :</h3>
                                        <div class="details-client">
                                            <p><?= $rdv->details_rendez_vous ?></p>
                                        </div>
                                    </li>
                                    <div class="icones_container">
                                        <a href="/coiffhair/Users/modify_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>"><img src="/coiffhair/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                                        <a onclick="openPopUp(<?= $rdv->id_rendez_vous ?>)"><img class="icone_suppr" src="/coiffhair/assets/images/supprimer.png" alt="supprimer"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="pop-up" id="pop-up-<?= $rdv->id_rendez_vous ?>">
                                <p>Êtes-vous sûr de vouloir supprimer le rendez-vous du <?= date('d/m', strtotime($rdv->date_rendez_vous)) ?> à <?= date('H\hi', strtotime($rdv->heure_rendez_vous)) ?> chez <?= $rdv->name ?>?</p>
                                <a href="/coiffhair/Users/delete_rdv?id_rdv=<?= $rdv->id_rendez_vous ?>" class="delete-btn">Supprimer</a>
                                <button onclick="closePopUp(<?= $rdv->id_rendez_vous ?>)" class="nope-btn">Annuler</button>
                            </div>
                    <?php }
                    } ?>
                </ul>
            <?php } ?>
            <hr>
            <?php if ((count($next_rdv)) < 1) { ?>
                <a class="button" href="/coiffhair/Users/rendez_vous">Prendre un rendez-vous</a>
            <?php } else if (count($next_rdv) >= 1 && count($next_rdv) < 3) { ?>
                <a class="button" href="/coiffhair/Users/rendez_vous">Prendre un autre rendez-vous</a>
            <?php } else { ?>
                <p class="error">Vous avez atteint le nombre maximum de rendez-vous.</p>
            <?php } ?>
            <a style="background-color:white; color:<?= $color ?>" href="http://[::1]/coiffhair/welcome/infos" class="button">Voir nos salons</a>
            <?php if ((count($old_rdv)) > 0) { ?>
                <a class="toggleButton button" id="toggleButton">Voir mes rendez-vous passés</a>
                <div class="ligne2" style="display:none;">
                    <ul>
                        <?php
                        // Trier les rendez-vous par ordre décroissant
                        usort($old_rdv, function ($a, $b) {
                            return strtotime($b->date_rendez_vous . ' ' . $b->heure_rendez_vous) - strtotime($a->date_rendez_vous . ' ' . $a->heure_rendez_vous);
                        });

                        foreach ($old_rdv as $rdv) { ?>
                            <div class="past-li">
                                <li><i>Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H\hi', strtotime($rdv->heure_rendez_vous)) ?>.</i>
                                    <br><span>Détails : <?= $rdv->details_rendez_vous ?>.</span>
                                </li>
                            </div>
                            <div class="pop-up" id="pop-up-suppr-all">
                                <p>Cette action est irréversible</p>
                                <p>Confirmez la suppression</p>
                                <a href="/coiffhair/Users/delete_old_rdv" class="delete-btn">Supprimer</a>
                                <button onclick="closePopUpSupprAll()" class="nope-btn">Annuler</button>
                            </div>
                        <?php } ?>
                    </ul>
                    <button class="delete-btn" onclick="openPopUpSupprAll()">Supprimer les rdv passés</button>
                </div>
            <?php } ?>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php') ?>
    </div>
</body>
<script>
    toggleButton();
    <?php foreach ($next_rdv as $rdv) { ?>
        var popUp<?= $rdv->id_rendez_vous ?> = document.getElementById('pop-up-<?= $rdv->id_rendez_vous ?>');
    <?php } ?>

    function openPopUp(rdvId) {
        var popUp = document.getElementById('pop-up-' + rdvId);
        popUp.style.display = "flex";
    }

    function closePopUp(rdvId) {
        var popUp = document.getElementById('pop-up-' + rdvId);
        popUp.style.display = "none";
    }

    var popUpSupprAll = document.getElementById('pop-up-suppr-all');

    function openPopUpSupprAll() {
        popUpSupprAll.style.display = "flex";
    }

    function closePopUpSupprAll() {
        popUpSupprAll.style.display = "none"
    }
</script>

</html>