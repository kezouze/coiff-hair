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
            <?php if (count($all_rdv) < 1) { ?>
                <h2>Vous n'avez pas de rendez-vous aujourd'hui.</h2>
            <?php } else { ?>
                <h2>Vos rendez-vous du <?= date('d/m/y'); ?> </h2>
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
                }
                ?>
                </ul>
                <hr>
                <a href="http://[::1]/coiffhair/Pros/updateInfos" class="button" style="background:<?= $color ?>">Mettez à jour vos infos</a>
                <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $_SESSION['id'] ?>" class="button" style="background:<?= $color ?>">Voir votre page</a>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>