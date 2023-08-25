<!DOCTYPE html>
<html lang="en">

<?php
$title = "Renseigner / modifier vos informations";
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <input name="adresse" placeholder="N° de voie et adresse" value="" type="number">
                <input name="code postal" placeholder="Code postal" value="" type="number">
                <input name="ville" placeholder="ville" value="" type="text">
                <input name="téléphone" placeholder="Téléphone" value="" type="number">
                <input name="email" placeholder="Email" value="" type="text">
                <input name="" placeholder="" value="" type="text">
                <input name="" placeholder="" value="" type="text">
                <input style="background:<?= $color ?>" class="button" type="submit">
            </form>
            <?php include(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>