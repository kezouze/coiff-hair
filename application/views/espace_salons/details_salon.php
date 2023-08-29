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
            <?php foreach ($all_data as $data) { ?>
                <div class="left">
                    <?php if ($data->photos !== "null") { // Pourquoi ce format bizarre ? 
                    ?>
                        <img src="<?= base_url('uploads/' . substr($data->photos, 2, 34)) ?>" class="big_img" alt="Photo du salon">
                    <?php } else { ?>
                        <img src="https://source.unsplash.com/random/600x400?hair" class="big_img" alt="Photo du salon">
                    <?php } ?>
                </div>
                <div class="right">
                    <p><?= substr($data->description, 0, 150) ?>...</p>
                    <hr>
                    <p><?= $data->address ?></p>
                    <p><?= $data->postal_code; ?> <?= strtoupper($data->city) ?></p>
                    <p><?= $data->telephone; ?></p>
                    <p><a href="mailto:<?= $data->email; ?>"><?= $data->email; ?></a></p>
                    <hr>
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "client") { ?>
                        <a href="http://[::1]/coiffhair/Users/rendez_vous?id=<?= $data->id_pro ?>&name=<?= $data->name ?>" style="background:<?= $color ?>" class="button">Réserver</a>
                    <?php } else { ?>
                        <button disabled href="" style="background:<?= $color ?>" class="button">Réserver</button>
                <?php }
                } ?>
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