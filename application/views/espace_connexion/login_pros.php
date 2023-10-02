<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Pros";
$color = "#b2272e";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <input type="text" name="email" placeholder="Votre email" value="<?= set_value('email') ?>">
                <input name="password" placeholder="Mot de passe" type="password">
                <input style="background:<?= $color ?>" class="button" type="submit" value="Connexion">
            </form>
            <?php include(APPPATH . 'views/includes/error_valid_messages.php') ?>
            <a href="<?= site_url() ?>Pros/forgot_password_pro">Mot de passe oublié ?</a>
            <hr>
            <a style="background:<?= $color ?>" class="button" href="<?= site_url() ?>Pros/inscriptionPros">Inscrivez-vous</a>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>