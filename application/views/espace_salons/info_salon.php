<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos Salons";
$color = "#2f4f4f";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <form style="flex-direction:row; margin-top:2rem;" action="" method="POST">
            <input type="search" class="search-input" name="search-input" placeholder="Recherchez par nom ou ville">
            <input class="button search-btn" type="submit" value="🔍">
        </form>
        <div class="salons_container">
            <?php if ($search_result !== "Nous n'avons pas trouvé de correspondance à votre recherche") { ?>
                <?php foreach ($search_result as $key) { ?>
                    <div class="card">
                        <h2><?= $key->name; ?></h2>
                        <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>"><img src="https://source.unsplash.com/random/300x200?hair" alt="exemple"></a>
                        <p><?= $key->email; ?></p>
                        <p><?= $key->boss; ?></p>
                    </div>
                <?php }
            } else { ?>
                <div>
                    <p><?= $search_result ?></p>
                </div>
                <?php foreach ($all_data as $key) { ?>
                    <div class="card">
                        <h2><?= $key->name; ?></h2>
                        <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>"><img src="https://source.unsplash.com/random/300x200?hair" alt="exemple"></a>
                        <p><?= $key->email; ?></p>
                        <p><?= $key->boss; ?></p>
                    </div>
            <?php }
            } ?>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>