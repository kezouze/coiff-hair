<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Professionnels";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <h1 class="pro">Espace Professionnel</h1>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Votre email">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <?php if (isset($error)) { ?>
            <p class="error"><?= $error ?></p>
        <?php } ?>
        <a href="http://[::1]/code_igniter_arthur/Pros/forgot_password">Mot de passe oublié ?</a>
        <hr class="dashed">
        <button class="inscription"><a href="http://[::1]/code_igniter_arthur/Pros/inscription">Inscrivez-vous</a></button>
        <button><a href="http://[::1]/code_igniter_arthur/Welcome">Retour</a></button>
    </div>
</body>

</html>