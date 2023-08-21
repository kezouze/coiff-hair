<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Bienvenue sur Coiff'Hair";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="header">
        <img id="icone" src="/code_igniter_arthur/assets/images/logo2.png" alt="coiffeur">
        <div class="small-container">
            <?php if (!isset($_SESSION['type'])) { ?>
                <h1>Connectez-vous</h1>
                <div class="buttons">
                    <a href="http://[::1]/code_igniter_arthur/Users" class="client client-button">Client</a>
                    <a href="http://[::1]/code_igniter_arthur/Pros" class="pro pro-button">Pro</a>
                    <?php } else {
                    if ($_SESSION['type'] === "client") { ?>
                        <a class="client client-button" href="http://[::1]/code_igniter_arthur/Users/logged">Retour à mon espace</a>
                    <?php } else if ($_SESSION['type'] === "pro") { ?>
                        <a class="pro pro-button" href="http://[::1]/code_igniter_arthur/Pros/logged">Retour à mon espace</a>
                    <?php } ?>
                    <a style="color:#ff033e" href="http://[::1]/code_igniter_arthur/Welcome/deconnect">Se déconnecter</a>
                <?php } ?>
                </div>
        </div>
    </div>
</body>

</html>