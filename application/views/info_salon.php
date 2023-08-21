<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos établissements";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <h1>Nos salons</h1>
    <?php foreach ($all_data as $key) { ?>
        <div class="card">
            <img src="<?= base_url('assets/images/' . $key->image); ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $key->nom; ?></h5>
                <p class="card-text"><?= $key->adresse; ?></p>
                <p class="card-text"><?= $key->code_postal; ?></p>
                <p class="card-text"><?= $key->ville; ?></p>
                <p class="card-text"><?= $key->telephone; ?></p>
                <p class="card-text"><?= $key->email; ?></p>
                <a href="<?php echo site_url('Welcome/infos'); ?>" class="btn btn-primary">Prendre rendez-vous</a>
            </div>
        </div>
    <?php } ?>
</body>

</html>