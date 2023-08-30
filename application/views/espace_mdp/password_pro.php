<!DOCTYPE html>
<html lang="en">

<?php
$title = "Réinitialisation du mdp";
$color = "#b2272e";
$linkTo = "Pros";
require_once(APPPATH . 'views/includes/head.php');
?>

<div class="blur">
    <?php include(APPPATH . 'views/includes/header.php'); ?>
    <div class="content">
        <form action="" method="post">
            <input type="text" class="email-input" placeholder="Indiquez votre adresse mail" name="email">
            <input style="background:<?= $color ?>" class="button" type="submit" value="Envoyer">
        </form>
        <?php include(APPPATH . 'views/includes/error_valid_messages.php'); ?>
    </div>
    <?php include(APPPATH . 'views/includes/footer.php'); ?>
</div>

<body>

</body>

</html>