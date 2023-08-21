<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Clients";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <h1 class="client">Espace Client</h1>
        <form action="" method="post">
            <input type="text" name="identifiant" placeholder="Email ou pseudo">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <p class="error"><?= $error ?></p>
        <a href="http://[::1]/coiffhair/Users/forgot_password">Mot de passe oublié ?</a>
        <hr class="dashed">
        <button class="inscription"><a href="http://[::1]/coiffhair/Users/inscription">Inscrivez-vous</a></button class="inscription">
        <button><a href="http://[::1]/coiffhair/Welcome">Retour</a></button>
    </div>
</body>

</html>