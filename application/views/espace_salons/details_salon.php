<!DOCTYPE html>
<html lang="fr">

<?php
$title = $name;
$color = "#2f4f4f";
if (isset($_SESSION['type']) && $_SESSION['type'] == "pro") {
    $linkTo = "Pros";
} else
    $linkTo = "Welcome/infos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <!-- <div style="height: 100vh; display:flex; align-items: center; justify-content: center; gap: 3rem"> -->
    <!-- <img class="icone_previous" src="" alt="Précédent"> -->
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="details_content">
            <?php foreach ($all_data as $key) { ?>
                <div class="left">
                    <img src="https://source.unsplash.com/random/576x384?hair" alt="Photo du salon" class="big_img">
                </div>
                <div class="right">
                    <p><?= $key->address ?></p>
                    <p><?= $key->postal_code; ?> <?= $key->city ?></p>
                    <p><?= $key->email; ?></p>
                    <p><?= $key->telephone; ?></p>
                    <button data-id="<?= $id; ?>" class="likes" style="background:#2f4f4f; border:none; text-decoration:none;">👍🏻
                        <p id="likes" style="color:white;"><?= $key->likes; ?></p>
                    </button>
                    <a href="http://[::1]/coiffhair/Users/rendez_vous?id=<?= $key->id_pro ?>&name=<?= $key->name ?>" style="background:<?= $color ?>" class="button">Réserver</a>
                <?php } ?>
                </div>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
        <!-- <img class="icone_next" src="" alt="Suivant"> -->
        <!-- </div> -->
    </div>
</body>
<script>
    updateLikes();
</script>

</html>