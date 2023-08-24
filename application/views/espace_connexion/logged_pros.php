<!DOCTYPE html>
<html lang="fr">

<?php
$title = $infos[0]->name;
$color = "#b2272e";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Voici la liste de vos rendez-vous du jour :</h2>
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
            <?php include(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>