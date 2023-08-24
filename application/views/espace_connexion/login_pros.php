<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Pros";
$color = "#b2272e";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Votre email">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <?php if (isset($error)) { ?>
            <p class="error"><?= $error ?></p>
        <?php } ?>
        <a href="http://[::1]/coiffhair/Pros/forgot_password">Mot de passe oublié ?</a>
        <hr class="dashed">
        <button class="inscription"><a href="http://[::1]/coiffhair/Pros/inscription">Inscrivez-vous</a></button>
        <a href="http://[::1]/coiffhair/Welcome" class="retour-button" style="background-color:#b2272e">Retour</a>
    </div>
</body>

</html>