<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'];
$color = "#b2272e";
$linkTo = "Pros/updateInfos";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Renseignez des prestations</h2>
            <form action="" method="post">
                <input placeholder="Nom" name="presta_name" value="<?= set_value('presta_name') ?>" type="text">
                <input placeholder="Prix" name="presta_cost" value="<?= set_value('presta_cost') ?>" type="number" step="0.01">
                <textarea placeholder="Description" name="presta_descr" value="<?= set_value('presta_descr') ?>" cols="29" rows="5"></textarea>
                <input class="button" style="background:<?= $color ?>" type="submit" value="Envoyer">
                <?php include(APPPATH . 'views/includes/error_valid_messages.php'); ?>
            </form>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>