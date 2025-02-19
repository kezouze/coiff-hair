<!DOCTYPE html>
<html lang="en">

<?php
$title = "Oops !";
$color = "#2f4f4f";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <img class="img404" src="<?= base_url('assets/images/404.png') ?>" alt="Erreur 404">
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>