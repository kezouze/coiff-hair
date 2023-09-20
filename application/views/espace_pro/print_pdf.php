<!DOCTYPE html>
<html lang="fr">
<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "/Pros";
include(APPPATH . '/views/includes/head.php'); ?>

<body class="pro">
    <div class="blur">
        <?php include(APPPATH . '/views/includes/header.php'); ?>
        <div class="content">
            <h1>Impression de votre planning</h1>
        </div>
        <?php include(APPPATH . '/views/includes/footer.php'); ?>
    </div>
</body>

</html>