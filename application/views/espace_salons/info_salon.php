<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos établissements";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="infos_container">
        <div class="infos_header">
            <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
            <h1 class="titre">Nos salons</h1>
        </div>
        <?php foreach ($all_data as $key) { ?>
            <div class="card">
                <h3><?= $key->name; ?></h3>
                <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>"><img src="https://source.unsplash.com/featured/300x200" alt="exemple"></a>
                <p><?= $key->email; ?></p>
            </div>
        <?php } ?>
        <a href="http://[::1]/coiffhair/Welcome" class="retour-button" style="background-color:#2f4f4f">Retour</a>
    </div>
</body>

</html>