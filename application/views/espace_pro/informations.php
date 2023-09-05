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
                <?php foreach ($data as $key) { ?>
                    <input name="address" placeholder="N° de voie et adresse" value="<?= $key->address ?>" type="text">
                    <input name="postal_code" placeholder="Code postal" value="<?= $key->postal_code != 0 ? $key->postal_code : '' ?>" type="number">
                    <input name="city" placeholder="Ville" value="<?= $key->city ?>" type="text">
                    <input name="telephone" placeholder="Téléphone" value="<?= $key->telephone != 0 ? $key->telephone : '' ?>" type="text">
                    <input name="email" placeholder="Email" value="<?= $key->email ?>" type="text">
                    <input style="background:<?= $color ?>" class="button" type="submit">
                <?php } ?>
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