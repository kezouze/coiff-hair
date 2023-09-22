<!DOCTYPE html>
<html lang="fr">

<?php
$title = $name . ' - Prestations';
$color = "#2f4f4f";
$linkTo = "/Welcome/details?id=" . $_GET['id'];
include(APPPATH . '/views/includes/head.php');
// var_dump($exists);
?>

<body>
    <div class="blur">
        <?php include(APPPATH . '/views/includes/header.php'); ?>
        <div class="presta_container">
            <?php foreach ($all_prestas as $key) { ?>
                <div class="presta_card">
                    <h3><span><?= $key->presta_name ?></span> - <span><?= str_replace('.', ',', $key->presta_cost) ?>€</span></h3>
                    <p><?= $key->presta_descr ?></p>
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "pro") { ?>
                        <!-- <div class="icones_container"> -->
                        <a href="/coiffhair/Pros/modif_prestation?id=<?= $key->presta_id ?>"><img src="/coiffhair/assets/images/modifier.png" class="icone_modif" alt="modifier"></a>
                        <a onclick="openPopUp(<?= $key->presta_id ?>)"><img class="icone_suppr" src="/coiffhair/assets/images/supprimer.png" alt="supprimer"></a>
                        <!-- </div> -->
                        <div id="pop-up-<?= $key->presta_id ?>" class="pop-up">
                            <p>Voulez-vous vraiment supprimer le soin "<?= $key->presta_name ?>" ?</p>
                            <a onclick="closePopUp(<?= $key->presta_id ?>)" class="nope-btn">Annuler</a>
                            <a href="/coiffhair/Pros/delete_prestation?id=<?= $key->presta_id ?>" class="button delete-btn">Supprimer</a>
                        </div>
                    <?php } ?>
                </div>
            <?php }
            if (empty($all_prestas)) { ?>
                <p>Revenez bientôt pour des nouveautés !</p>
            <?php } ?>
        </div>
        <?php include(APPPATH . '/views/includes/footer.php'); ?>
    </div>
</body>
<script>
    function openPopUp(prestaId) {
        var popUp = document.getElementById('pop-up-' + prestaId);
        popUp.style.display = "flex";
    }

    function closePopUp(prestaId) {
        var popUp = document.getElementById('pop-up-' + prestaId);
        popUp.style.display = "none";
    }
</script>

</html>