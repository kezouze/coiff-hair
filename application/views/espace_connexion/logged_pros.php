<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace professionnel";
$color = "#b2272e";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <h2 style="color:<?= $color ?>;">Bienvenue cher professionnel !</h2>
        <p>Voici la liste de vos rendez-vous du jour :</p>
        <ul>
            <?php
            foreach ($all_rdv as $key) { ?>
                <div class="ligne">
                    <div class="li">
                        <li><span class="first_line"><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> : <?= ucfirst($key->last_name) . ' ' . ucfirst($key->first_name) ?></span>
                            <p>Détails : <i><?= $key->details_rendez_vous ?></i></p>
                        </li>
                    </div>
                </div>
            <?php
            }
            ?>
        </ul>
        <a style="color:#ff033e" href="/coiffhair/Pros/deconnect">Se déconnecter</a>
    </div>
</body>

</html>