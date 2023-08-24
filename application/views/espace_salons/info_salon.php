<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos Salons";
$color = "#2f4f4f";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="salons_container">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <span class="topGap"></span>
        <?php foreach ($all_data as $key) { ?>
            <div class="card">
                <h3><?= $key->name; ?></h3>
                <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>&&name=<?= $key->name ?>"><img src="https://source.unsplash.com/featured/300x200" alt="exemple"></a>
                <p><?= $key->email; ?></p>
            </div>
        <?php } ?>
        <span class="bottomGap"></span>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>