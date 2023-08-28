<!DOCTYPE html>
<html lang="en">

<?php
$title = "Renseigner / modifier la présentation";
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <textarea placeholder="Écrivez une description de votre établissement" type="text" name="description"></textarea>
                <input class="button" style="background:<?= $color ?>" type="submit" value="Envoyer">
            </form>
            <?php require(APPPATH . 'views/includes/error_valid_messages.php'); ?>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>