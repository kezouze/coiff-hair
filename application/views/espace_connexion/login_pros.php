<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion Professionnels";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <h1 style="text-align: center">Bienvenue !</h1>
        <h2>Espace Professionnels</h2>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Votre email">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <?= validation_errors(); ?>
        <p class="error"><?= $error ?></p>
        <a href="http://[::1]/code_igniter_arthur/Pros/forgot_password">Mot de passe oublié ?</a>
        <h4>Ou inscrivez-vous <a href="http://[::1]/code_igniter_arthur/Pros/inscription">ici</a> !</h4>
        <h4><a href="http://[::1]/code_igniter_arthur/Users/">Espace client</a></h4>
    </div>
</body>

</html>