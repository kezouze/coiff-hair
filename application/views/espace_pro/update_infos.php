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
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/informations">Informations</a></h2>
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/presentation">Présentation</a></h2>
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/photos">Photos</a></h2>
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/horaires">Horaires</a></h2>
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/services">Services</a></h2>
            <h2><a style="background:<?= $color ?>;" class="button" href="http://[::1]/coiffhair/Pros/produits">Produits</a></h2>
            <?php include(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>