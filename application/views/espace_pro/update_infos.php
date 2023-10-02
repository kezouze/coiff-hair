<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Pros";
require_once(APPPATH . 'views/includes/head.php');
?>

<body class="pro">
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Sélectionnez la catégorie</h2>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="<?= site_url() ?>Pros/informations">Informations</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="<?= site_url() ?>Pros/presentation">Présentation</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="<?= site_url() ?>Pros/photos">Photos</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="<?= site_url() ?>Pros/horaires">Horaires</a>
            <a style="background:<?= $color ?>;" class="button btn-update-infos" href="<?= site_url() ?>Pros/prestations">Prestations</a>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>