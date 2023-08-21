<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace professionnel";
require_once(APPPATH . 'views/includes/head.php');
// echo $_SESSION['id']; // Ça n'affiche rien en dehors du container ?
$color = "#a04141";
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
        <a style="color:#ff033e" href="/code_igniter_arthur/Pros/deconnect">Se déconnecter</a>
    </div>
</body>

</html>