<!DOCTYPE html>
<html lang="fr">
<?php
$title = $name . ' - Prestations';
$color = "#2f4f4f";
$linkTo = "/Welcome/details?id=" . $_GET['id'];
include(APPPATH . '/views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . '/views/includes/header.php'); ?>
        <!-- <div class="presta_container"> -->
        <?php foreach ($all_prestas as $key) { ?>
            <div class="presta_card">
                <h3><?= $key->presta_name ?></h3>
                <p><?= $key->presta_descr ?></p>
                <p><?= str_replace('.', ',', $key->presta_cost) ?>€</p>
                <p></p>
            </div>
        <?php } ?>
        <!-- </div> -->
        <?php include(APPPATH . '/views/includes/footer.php'); ?>
    </div>
</body>

</html>