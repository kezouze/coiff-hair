<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier mdp";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <h2>Modification de votre mot de passe</h2>
        <form action="" method="post">
            <input minlength="6" placeholder="Votre nouveau mdp" type="password" name="new_password">
            <i>6 caractères minimum</i>
            <input placeholder="Confirmez votre saisie" type="password" name="confirm_new_password">
            <input type="submit">
            <p class="error"><?= $error ?></p>
            <p class="valid"><?= $valid ?></p>
        </form>
        <p>Retour à la <a href="http://[::1]/code_igniter_arthur/Users">page de connexion</a></p>
    </div>
</body>

</html>