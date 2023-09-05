<!DOCTYPE html>
<html lang="en">
<?php
$title = $name;
$color = "#2f4f4f";
$linkTo = "/Welcome/details?id=" . $_GET['id'];
include(APPPATH . '/views/includes/head.php'); ?>

<body>
    <div class="blur">
        <?php include(APPPATH . '/views/includes/header.php'); ?>
        <div class="content">
            <h1>Les prestations proposées</h1>
        </div>
        <?php include(APPPATH . '/views/includes/footer.php'); ?>
    </div>
</body>

</html>