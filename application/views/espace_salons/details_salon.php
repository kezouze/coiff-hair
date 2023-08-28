<!DOCTYPE html>
<html lang="fr">

<?php
$title = $name;
$color = "#2f4f4f";
if (isset($_SESSION['type']) && $_SESSION['type'] == "pro") {
    $linkTo = "Pros";
} else {
    $linkTo = "Welcome/infos";
}
$add = '<button data-id="' . $id . '" class="likes">👍🏻
        <p id="likes" style="color:white;">' . $likes . '</p>
    </button>';
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
                    <?php if ($key->photo !== "") { ?>
                        <img src="<?= base_url('uploads/' . $key->photo) ?>" class="big_img" alt="Photo du salon">
                    <?php } else { ?>
                        <img src="https://source.unsplash.com/random/600x400?hair" class="big_img" alt="Photo du salon">
                    <?php } ?>
                </div>
                <div class="right">
                    <p><?= substr($key->description, 0, 150) ?>...</p>
                    <hr>
                    <p><?= $key->address ?></p>
                    <p><?= $key->postal_code; ?> <?= $key->city ?></p>
                    <p><?= $key->telephone; ?></p>
                    <p><?= $key->email; ?></p>
                    <hr>
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