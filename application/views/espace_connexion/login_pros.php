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
                <input required type="text" name="email" placeholder="Votre email" value="<?= set_value('email') ?>">
                <input required name="password" placeholder="Mot de passe" type="password">
                <input style="background:<?= $color ?>" class="button" type="submit" value="Connexion">
            </form>
            <?php if (isset($error)) { ?>
                <p class="error"><?= $error ?></p>
            <?php } ?>
            <a href="http://[::1]/coiffhair/Pros/forgot_password">Mot de passe oublié ?</a>
            <hr>
            <a style="background:<?= $color ?>" class="button" href="http://[::1]/coiffhair/Pros/inscriptionPros">Inscrivez-vous</a>
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>