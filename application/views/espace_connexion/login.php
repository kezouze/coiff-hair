<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Clients";
$color = "#0964cc";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <input type="text" name="identifiant" placeholder="Email ou pseudo">
                <input name="password" placeholder="Mot de passe" type="password">
                <input type="submit" value="Connexion">
            </form>
            <p class="error"><?= $error ?></p>
            <a href="http://[::1]/coiffhair/Users/forgot_password">Mot de passe oublié ?</a>
            <button class="inscription"><a href="http://[::1]/coiffhair/Users/inscription">Inscrivez-vous</a></button>
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>