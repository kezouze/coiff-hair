<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Inscription";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <h1 style="text-align: center">Inscription</h1>
        <form action="" method="post">
            <div class="gender">
                <input value="M" name="gender" type="radio">Mr</input>
                <input value="F" name="gender" type="radio">Mme</input>
                <input value="O" name="gender" type="radio">Autre</input>
            </div>
            <input placeholder="Nom" name="last_name" type="text">
            <input placeholder="Prénom" name="first_name" type="text">
            <input placeholder="Votre Pseudo" name="pseudo" type="text">
            <input placeholder="Votre Email" name="email" type="text">
            <input minlength="6" placeholder="Votre Mot de Passe" name="password" type="password">
            <i>6 caractères minimum</i>
            <input placeholder="Confirmer Votre MDP" name="confirm_password" type="password">
            <input type="submit" value="Envoyer">
        </form>
        <p style="color: red;" class="error"><?= $error ?></p>
        <p style="color: green;" class="valid"><?= $valid ?></p>
        <p><a href="http://[::1]/code_igniter_arthur/Users">Retour</a></p>
    </div>
</body>

</html>