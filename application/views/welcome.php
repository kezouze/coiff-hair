<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Bienvenue sur coiffhair";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="header">
        <div class="titre">
            <img id="big-icone" src="/coiffhair/assets/images/logo2.png" alt="coiffeur">
            <h1 class="main-titre">Votre style, notre affaire !</h1>
        </div>
        <div class="small-container">
            <?php if (!isset($_SESSION['type'])) { ?>
                <div class="buttons">
                    <a href="http://[::1]/coiffhair/Welcome/infos" class="infos infos-button">Voir nos salons</a>
                    <a href="http://[::1]/coiffhair/Welcome/about" class="infos infos-button">À propos</a>
                </div>
                <h3>Connexion ou inscription:</h3>
                <div class="buttons">
                    <a href="http://[::1]/coiffhair/Users" class="client client-button">Client</a>
                    <a href="http://[::1]/coiffhair/Pros" class="pro pro-button">Pro</a>
                    <?php } else {
                    if ($_SESSION['type'] === "client") { ?>
                        <a class="client client-button" href="http://[::1]/coiffhair/Users/logged">Retour à mon espace</a>
                        <a href="http://[::1]/coiffhair/Welcome/infos" class="infos infos-button">Voir nos salons</a>
                    <?php } else if ($_SESSION['type'] === "pro") { ?>
                        <a class="pro pro-button" href="http://[::1]/coiffhair/Pros/logged">Retour à mon espace</a>
                    <?php } ?>
                    <a style="color:#ff033e" href="http://[::1]/coiffhair/Welcome/deconnect">Se déconnecter</a>
                <?php } ?>
                </div>
        </div>
    </div>
</body>

</html>