<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Pros";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Sélectionnez la catégorie</h2>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="http://[::1]/coiffhair/Pros/informations">Informations</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="http://[::1]/coiffhair/Pros/presentation">Présentation</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="http://[::1]/coiffhair/Pros/photos">Photos</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="http://[::1]/coiffhair/Pros/horaires">Horaires</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="http://[::1]/coiffhair/Pros/prestations">Prestations</a>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>