<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Renseignez / modifiez vos informations</h2>
            <form action="" method="post">
                <input name="address" placeholder="N° de voie et adresse" value="<?= set_value('address') ?>" type="text">
                <input name="postal_code" placeholder="Code postal" value="<?= set_value('postal_code') ?>" type="number">
                <input name="city" placeholder="Ville" value="<?= set_value('city') ?>" type="text">
                <input name="telephone" placeholder="Téléphone" value="<?= set_value('telephone') ?>" type="number">
                <input name="email" placeholder="Email" value="<?= $email ?>" type="text">
                <!-- <input name="" placeholder="" value="" type="text">
                <input name="" placeholder="" value="" type="text"> -->
                <input style="background:<?= $color ?>" class="button" type="submit">
                <span class="error">
                    <?php
                    if (isset($error)) {
                        echo $error;
                    } ?>
                </span>
                <span class="valid">
                    <?php if (isset($valid)) {
                        echo $valid;
                    }
                    ?>
                </span>
            </form>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>