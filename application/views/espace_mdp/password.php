<!DOCTYPE html>
<html lang="en">

<?php
$title = "Modifier mdp";
require_once(APPPATH . 'views/includes/head.php');
?>

<div class="container">
    <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
    <h2>Réinitialisation de votre mot de passe :</h2>
    <form action="" method="post">
        <input placeholder="Indiquez votre adresse mail" type="email" name="email">
        <input type="submit" value="Envoyer">
    </form>
    <p class="error"><?= $error ?></p>
    <p class="valid"><?= $valid ?></p>

    <button><a href="http://[::1]/coiffhair/Users">Retour</a></button>
</div>

<body>

</body>

</html>