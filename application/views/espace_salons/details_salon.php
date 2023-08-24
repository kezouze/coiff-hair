<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Salon " . $name;
$color = "#2f4f4f";
$linkTo = "Welcome/infos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <!-- <div style="height: 100vh; display:flex; align-items: center; justify-content: center; gap: 3rem"> -->
    <!-- <img class="icone_previous" src="" alt="Précédent"> -->
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <?php foreach ($all_data as $key) { ?>
            <img src="https://source.unsplash.com/featured/576x384" alt="exemple" class="big_img">
            <p><?= $key->email; ?></p>
            <p><?= $key->boss; ?></p>

            <button data-id="<?= $id; ?>" class="likes" style="background:#2f4f4f; border:none; text-decoration:none;">👍🏻
                <p id="likes" style="color:white;"><?= $key->likes; ?></p>
            </button>

        <?php } ?>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
        <!-- <img class="icone_next" src="" alt="Suivant"> -->
        <!-- </div> -->
    </div>
</body>
<script>
    updateLikes();
</script>

</html>