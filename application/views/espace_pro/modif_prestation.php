<!DOCTYPE html>
<html lang="en">

<?php
$title = $_SESSION['name'] . ' - Modifier la prestation ';
$color = "#b2272e";
$linkTo = "Welcome/prestations?id=" . $_SESSION['id'];
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h2>Modifier la prestation "<span style="color:<?= $color ?>"><?= $presta[0]->presta_name ?>"</span></h2>
            <form action="" method="post">
                <input placeholder="Nom" name="presta_name" value="<?= $presta[0]->presta_name ?>" type="text">
                <input placeholder="Prix" name="presta_cost" value="<?= $presta[0]->presta_cost ?>" type="number" step="0.01">
                <textarea placeholder="Description" name="presta_descr" cols="29" rows="5"><?= $presta[0]->presta_descr ?></textarea>
                <input class="button" style="background:<?= $color ?>" type="submit" value="Envoyer">
                <?php include(APPPATH . 'views/includes/error_valid_messages.php'); ?>
            </form>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>