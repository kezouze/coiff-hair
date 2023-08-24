<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier mdp";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Modification de votre mot de passe</h2>
            <form action="" method="post">
                <input minlength="6" placeholder="Votre nouveau mdp" type="password" name="new_password">
                <i>6 caractères minimum</i>
                <input placeholder="Confirmez votre saisie" type="password" name="confirm_new_password">
                <input type="submit">
                <p class="error"><?= $error ?></p>
                <p class="valid"><?= $valid ?></p>
            </form>
            <?php include(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>