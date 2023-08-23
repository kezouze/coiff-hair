<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Informations";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <!-- <div style="height: 100vh; display:flex; align-items: center; justify-content: center; gap: 3rem"> -->
    <!-- <img class="icone_previous" src="" alt="Précédent"> -->
    <div style="row-gap:10px;" class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <?php foreach ($all_data as $key) { ?>
            <h3><?= $key->name; ?></h3>
            <img src="https://source.unsplash.com/featured/576x384" alt="exemple" class="big_img">
            <p><?= $key->email; ?></p>
            <p><?= $key->boss; ?></p>

            <button data-id="<?= $id; ?>" class="likes" style="background:#2f4f4f; border:none; text-decoration:none;">👍🏻
                <p id="likes" style="color:white;"><?= $key->likes; ?></p>
            </button>

        <?php } ?>
        <!-- </div> -->
        <!-- <img class="icone_next" src="" alt="Suivant"> -->
        <a href="http://[::1]/coiffhair/Welcome/infos" class="retour-button" style="background-color:#2f4f4f">Retour</a>
    </div>
</body>
<script>
    updateLikes();
</script>

</html>