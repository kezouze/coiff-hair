<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Inscription clients";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" method="post">
                <div class="gender">
                    <input value="M" name="gender" type="radio">Mr</input>
                    <input value="F" name="gender" type="radio">Mme</input>
                    <input value="O" name="gender" type="radio">Autre</input>
                </div>
                <input required placeholder="Nom" name="last_name" type="text">
                <input required placeholder="Prénom" name="first_name" type="text">
                <input placeholder="Votre Pseudo" name="pseudo" type="text">
                <input required placeholder="Votre Email" name="email" type="text">
                <input required placeholder="Votre Mot de Passe" name="password" type="password">
                <i>6 caractères minimum</i>
                <input required placeholder="Confirmer Votre MDP" name="confirm_password" type="password">
                <input class="button" type="submit" value="Envoyer">
            </form>
            <span class="error">
                <?php
                if (isset($error)) {
                    echo $error;
                }
                if (isset($valid)) {
                    echo $valid;
                }
                ?>
            </span>
            <!-- <p class="error"></p>
            <p class="valid"></p> -->
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>

        </div>
    </div>
</body>

</html>