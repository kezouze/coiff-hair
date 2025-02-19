<!DOCTYPE html>
<html lang="en">

<?php
$title = "À propos";
$color = "#2f4f4f";
$linkTo = "Welcome";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php') ?>
        <div class="content">
            <div>
                <img class="photo-profil" src="<?= base_url('assets/images/photo-profil.jpg') ?>" alt="Photo de profil">
            </div>
            <div class="about-text-container">
                <p>Bienvenue à vous sur mon site !</p>
                <p>Il s'agit de mon projet de fin d'études en développement web.</p>
                <p>Il est réalisé avec le framework PHP CodeIgniter3, vous trouverez le code source <a target="_blank" class="link" href="https://github.com/kezouze/coiff-hair">ici</a></p>
                <p>J'ai toujours été friand des innombrables jeux de mots dans le nom des salons de coiffure.</p>
                <p>Je vous recommande même de consulter un autre site amusant qui les recense ici : <a target="_blank" class="link" href="https://tif.hair/">tif.hair</a></p>
                <p>Pour toutes demandes, vous pouvez me contacter à cette adresse : <a target="_blank" class="link" href="mailto:vincent-c51@hotmail.fr">vincent-c51@hotmail.fr</a></p>
                <p>Merci de votre visite !</p>
            </div>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php') ?>
    </div>

</body>

</html>