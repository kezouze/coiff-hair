<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Automatisation de rdv";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php') ?>
        <div class="content">
            <h2>Rdv du <?= $date ?> à <?= $time ?> chez <?= $pro_name ?></h2>
            <h3>Définir une intervale :</h3>
            <form action="" method="post">
                <label for="range">Tous les <span style="font-size:1.5rem;color:<?= $color ?>" id="label">7</span> jours</label>
                <input type="range" name="range" id="range" min="7" max="31" value="7">
                <input type="submit" value="Valider" class="button">
            </form>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>
<script>
    const rangeInput = document.getElementById('range');
    const valeurSelectionnee = document.getElementById('label');
    rangeInput.addEventListener('input', () => {
        valeurSelectionnee.textContent = rangeInput.value;
    });
</script>

</html>