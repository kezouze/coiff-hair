<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Bienvenue sur Coiffhair";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="welcome-container">
        <div class="titre">
            <img id="big-icone" src="<?= base_url('assets/images/logo2.png') ?>" alt="coiffeur">
            <h1 class="main-title">Votre style, notre affaire !</h1>
        </div>
        <div class="small-container">
            <?php if (!isset($_SESSION['type'])) { ?>
                <div class="buttons">
                    <a href="<?= site_url() ?>Welcome/infos" class="infos infos-button">Voir nos salons</a>
                    <a href="<?= site_url() ?>Welcome/about" class="infos about-button">À propos</a>
                </div>
                <h3>Connexion ou inscription:</h3>
                <div class="buttons">
                    <a href="<?= site_url() ?>Users" class="client client-button">Client</a>
                    <a href="<?= site_url() ?>Pros" style="padding:10px 20px; width:fit-content" class="pro-button">Pro</a>
                    <?php } else {
                    if ($_SESSION['type'] === "client") { ?>
                        <a class="client client-button" href="<?= site_url() ?>Users/logged">Retour à mon espace</a>
                        <a href="<?= site_url() ?>Welcome/infos" class="infos infos-button">Voir nos salons</a>
                    <?php } else if ($_SESSION['type'] === "pro") { ?>
                        <a class="pro-button" href="<?= site_url() ?>Pros/logged">Retour à mon espace</a>
                    <?php } ?>
                    <a style="color:#ff033e" href="<?= site_url() ?>Welcome/deconnect">Se déconnecter</a>
                <?php } ?>
                </div>
        </div>
    </div>
    <audio src="/coiffhair/assets/audio/uwu.mp3" type="audio/mpeg" id="uwuAudio"></audio>
</body>
<script>
    easterEgg();
</script>

</html>