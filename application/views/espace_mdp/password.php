<!DOCTYPE html>
<html lang="en">

<?php
$title = "Modifier mdp";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<div class="blur">
    <?php include(APPPATH . 'views/includes/header.php'); ?>
    <div class="content">
        <h2>Réinitialisation de votre mot de passe :</h2>
        <form action="" method="post">
            <input placeholder="Indiquez votre adresse mail" type="email" name="email">
            <input type="submit" value="Envoyer">
        </form>
        <p class="error"><?= $error ?></p>
        <p class="valid"><?= $valid ?></p>
    </div>
    <?php include(APPPATH . 'views/includes/footer.php'); ?>
</div>

<body>

</body>

</html>