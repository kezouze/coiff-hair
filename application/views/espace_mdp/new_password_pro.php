<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier mdp";
$color = "#b2272e";
$linkTo = "Pros";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <input placeholder="Votre nouveau mdp" type="password" name="new_password">
                <i>6 caractères minimum</i>
                <input placeholder="Confirmez votre saisie" type="password" name="confirm_new_password">
                <input style="background:<?= $color ?>" class="button" type="submit">
                <?php include(APPPATH . 'views/includes/error_valid_messages.php'); ?>
            </form>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>