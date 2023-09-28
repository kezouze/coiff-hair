<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body class="pro">
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <div>
                <p>Mode vacances</p>
                <input data="<?= $isOnHolidays ?>" type="checkbox" id="holidays" name="holidays" <?= $isOnHolidays ? 'checked' : '' ?>>
            </div>
            <h2>Renseigner / modifier vos horaires</h2>
            <h4>Heure d'ouverture</h4>
            <h4>Heure de fermeture</h4>
            <h4>Durée de la prestation</h4>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>
<script>
    isOnHolidays();
</script>

</html>