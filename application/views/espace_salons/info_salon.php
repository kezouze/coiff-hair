<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos Salons";
$color = "#2f4f4f";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur" style="justify-content:flex-start;">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <form style="flex-direction:row; margin:2rem 0;" action="" method="POST">
            <input type="search" class="search-input" name="search-input" placeholder="Nom, code postal ou ville">
            <input class="button search-btn" type="submit" value="🔍">
        </form>
        <?php include_once(APPPATH . 'views/includes/error_valid_messages.php'); ?>
        <?php if ($search_result) { ?>
            <h2>Résultat de recherche pour "<span style="font-size:2rem;"><?= $search ?></span>"</h2>
            <div class="salons_container">
                <?php foreach ($search_result as $key) { ?>
                    <div class="card">
                        <h1><?= $key->name; ?></h1>
                        <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>"><img src="https://source.unsplash.com/random/300x200?hair" alt="exemple"></a>
                        <p><?= $key->address; ?></p>
                        <p><?= $key->postal_code; ?></p>
                        <p><?= $key->city ?></p>
                    </div>
                <?php } ?>
            </div>
            <p><a style="background:<?= $color ?>; margin-bottom:1rem;" href="" class="button">Tous les salons</a></p>
        <?php } else { ?>
            <div class="salons_container">
                <?php foreach ($all_data as $key) { ?>
                    <div class="card">
                        <h1><?= $key->name; ?></h1>
                        <a href="http://[::1]/coiffhair/Welcome/details?id=<?= $key->id_pro ?>"><img src="https://source.unsplash.com/random/300x200?hair" alt="exemple"></a>
                        <p><?= $key->address; ?></p>
                        <p><?= $key->postal_code; ?></p>
                        <p><?= $key->city ?></p>
                    </div>
            <?php }
            } ?>
            </div>
    </div>
    <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>

</html>