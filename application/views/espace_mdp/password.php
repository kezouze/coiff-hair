<!DOCTYPE html>
<html lang="en">

<?php
$title = "Modifier mdp";
require_once(APPPATH . 'views/includes/head.php');
?>

<div class="container">
    <h2>Réinitialisation de votre mot de passe :</h2>
    <form action="" method="post">
        <input placeholder="Indiquez votre adresse mail" type="email" name="email">
        <input type="submit" value="Envoyer">
    </form>
    <p class="error"><?= $error ?></p>
    <p class="valid"><?= $valid ?></p>

    <a href="http://[::1]/code_igniter_arthur/Users">Retour</a>
</div>

<body>

</body>

</html>