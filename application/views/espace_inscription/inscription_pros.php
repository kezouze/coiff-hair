<!DOCTYPE html>
<html lang="en">

<?php
$title = "Inscription Pros";
$color = "#b2272e";
$linkTo = "Pros";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <form action="" name="formPro" method="post">
                <input name="name" placeholder="Nom du salon" type="text" value="<?= set_value('name') ?>">
                <input name="boss" placeholder="Responsable" type="text" value="<?= set_value('boss') ?>">
                <input name="email" placeholder="Adresse email" type="text" value="<?= set_value('email') ?>">
                <input name="password" placeholder="Mot de passe" type="password">
                <i>6 caractères minimum</i>
                <input name="passwordConf" placeholder="Confirmer mdp" type="password">
                <input style="background:<?= $color ?>" class="button" type="submit" value="Envoyer">
                <span class="error">
                    <?php
                    if (isset($error)) {
                        echo $error;
                    } ?>
                </span>
                <span class="valid">
                    <?php if (isset($valid)) {
                        echo $valid;
                    }
                    ?>
                </span>
            </form>
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>