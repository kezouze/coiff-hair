<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php if ($gender == 'M') { ?>
            <h3>Bienvenue <?= '<b style="color:#00c8ff; font-size:30px;">' . ucfirst($first_name) . '</b>' . ' !' ?></h3>
        <?php } else if ($gender == 'F') { ?>
            <h3>Bienvenue <?= '<b style="color:hotpink; font-size:30px">' . ucfirst($first_name) . '</b>' . ' !' ?></h3>
        <?php } else { ?>
            <h3>Bienvenue <?= '<b style="color:#3cd070; font-size:30px">' . ucfirst($first_name) . '</b>' . ' !' ?></h3>
        <?php } ?>
        <?php if (count($next_rdv) == 0) { ?>
            <p>Vous n'avez pas de rendez-vous à venir</p>
        <?php } else { ?>
            <p>Vous avez <?= (count($next_rdv)) ?> rendez-vous à venir :</p>
            <ul>
                <?php foreach ($next_rdv as $rdv) {
                    if ($rdv->date_rendez_vous >= date('Y-m-d')) { ?>
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
                <?php }
                } ?>
            </ul>
        <?php } ?>
        <?php if ((count($next_rdv)) < 1) { ?>
            <a href="/code_igniter_arthur/Users/rendez_vous">Prendre un rendez-vous</a>
        <?php } else if (count($next_rdv) >= 1 && count($next_rdv) < 3) { ?>
            <a href="/code_igniter_arthur/Users/rendez_vous">Prendre un autre rendez-vous</a>
        <?php } else { ?>
            <p class="error">Vous avez atteint le nombre maximum de rendez-vous.</p>
        <?php } ?>
        <?php if ((count($old_rdv)) > 0) { ?>
            <button class="toggleButton" id="toggleButton">Voir mes rendez-vous passés</button>
            <ul>
                <?php foreach ($old_rdv as $rdv) { ?>
                    <div class="ligne2" style="display:none;">
                        <div class="li">
                            <li><i>Le <?= date('d/m/Y', strtotime($rdv->date_rendez_vous)) . ' à ' . date('H:i', strtotime($rdv->heure_rendez_vous)) . '.</i>
                        <br><span>Détails : ' . $rdv->details_rendez_vous ?></span></li>
                        </div>
                    </div>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php if (count($old_rdv) > 0) { ?>
            <a style="color:red" href="/code_igniter_arthur/Users/delete_old_rdv">Supprimer les rdv passés</a>
        <?php } ?>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#toggleButton").click(function() {
            $(".ligne2").toggle();
            // on change le texte du bouton :
            var buttonText = $(".ligne2").is(":visible") ? "Cacher mes rendez-vous passés" : "Voir mes rendez-vous passés";
            $(this).text(buttonText);

        });
    });
</script>

</html>