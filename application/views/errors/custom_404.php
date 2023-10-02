<!DOCTYPE html>
<html lang="en">

<?php
$title = "Bienvenue sur coiffhair";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <img class="img404" src="/coiffhair/assets/images/404.png" alt="Erreur 404">
        <a href="<?= site_url() ?>Welcome" class="retour-button" style="background-color:#2f4f4f">Retour</a>
    </div>
</body>

</html>