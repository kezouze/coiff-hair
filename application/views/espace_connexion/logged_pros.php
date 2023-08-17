<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Votre espace professionnel";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <h1>Bienvenue cher professionnel !</h1>
        <h2>Voici la liste de vos rendez-vous du jour :</h2>
        <ul>
            <?php
            foreach ($all_rdv as $key) { ?>
                <div class="ligne">
                    <li><span class="first_line"><?= date('H\hi', strtotime($key->heure_rendez_vous)) ?> : Mme/Mr <?= ucfirst($key->last_name) . ' ' . ucfirst($key->first_name) ?></span>
                        <i>
                            <h4><?= $key->details_rendez_vous ?></h4>
                        </i>
                    </li>
                </div>
            <?php
            }
            ?>
        </ul>
        <a style="color:red" href="/code_igniter_arthur/Pros/deconnect">Se déconnecter</a>
    </div>
</body>

</html>