<!DOCTYPE html>
<html lang="en">

<?php
$title = "Ajout de photos";
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="photo" id="photo">
                <input class="button" style="background:<?= $color ?>" type="submit" value="Envoyer">
            </form>
            <?php require(APPPATH . 'views/includes/error_valid_messages.php'); ?>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>