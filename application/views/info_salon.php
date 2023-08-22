<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Nos établissements";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="infos_container">
        <div class="infos_header">
            <h1 class="titre">Nos salons</h1>
        </div>
        <?php foreach ($all_data as $key) { ?>
            <div class="card">
                <h3><?= $key->name; ?></h3>
                <img src="https://source.unsplash.com/featured/300x200" alt="exemple">
                <p><?= $key->email; ?></p>
            </div>
        <?php } ?>
    </div>
    </div>
</body>

</html>