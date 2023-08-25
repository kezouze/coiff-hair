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
                <input name="name" placeholder="Nom du salon" type="text">
                <input name="boss" placeholder="Responsable" type="text">
                <input name="email" placeholder="Adresse email" type="text">
                <input name="password" placeholder="Mot de passe" type="password">
                <i>6 caractères minimum</i>
                <input name="passwordConf" placeholder="Confirmer mdp" type="password">
                <input style="background:<?= $color ?>" class="button" type="submit" value="Envoyer">
                <div class="info" style="height:18px">
                    <?php if ($error) { ?>
                        <p class="error"><?= $error ?></p>
                    <?php } else if ($valid) { ?>
                        <p class="valid"><?= $valid ?></p>
                    <?php } ?>
                </div>
            </form>
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
</body>

</html>