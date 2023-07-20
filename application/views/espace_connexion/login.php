<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Connexion";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <h1 style="text-align: center"><span class="welcome">Bienvenue chez</h1>
        <img id="icone" src="/code_igniter_arthur/assets/images/logo2.png" alt="coiffeur">
        <form action="" method="post">
            <input type="text" name="identifiant" placeholder="Email ou pseudo">
            <input name="password" placeholder="Mot de passe" type="password">
            <input type="submit" value="Connexion">
        </form>
        <a href="http://[::1]/code_igniter_arthur/Users/forgot_password">Mot de passe oublié ?</a>
        <p class="error"><?= $error ?></p>
        <hr class="dashed">
        <h4><a href="http://[::1]/code_igniter_arthur/Users/inscription">Inscrivez-vous</a> !</h4>
        <!-- <h4><a href="http://[::1]/code_igniter_arthur/Pros">Espace professionnel</a></h4> -->
    </div>
</body>

</html>