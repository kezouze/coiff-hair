<!DOCTYPE html>
<html lang="en">

<?php
$title = "Prendre rdv";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <i>
            <h3>Nous sommes le <span id="today"><?= date('d/m/Y', strtotime($today)) ?></span> et il est <span id="horloge" onload="showtime()"></span> </h3>
        </i>
        <form action="" method="post">
            <label for="proSelect">Choisissez votre salon</label>
            <select name="proSelect" id="proSelect">
                <option value="1">coiffhair</option>
                <option value="2">Tête en l'Hair</option>
                <option value="3">Imagin'Hair</option>
            </select>
            <label for="date">Choisissez votre date</label>
            <input id="date" type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>">
            <label for="time">Nous sommes ouverts de 09h à 17h30</label>
            <select id="time" name="time">
                <?php foreach ($creneaux as $creneau) {
                    if ($creneau !== "indisponible") { ?>
                        <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                <?php }
                } ?>
            </select>
            <textarea required placeholder="Renseignez le but de votre visite :)" maxlength="1000" name="details" cols="29" rows="5"></textarea>
            <!-- Le bouton submit devrait être désactivé après un seul clic pour éviter les bugs de doublons. 
            Le required sur input[détails] fait l'affaire pour le moment -->
            <input type="submit" value="Réserver">
        </form>
        <?php if (isset($error) || isset($valid)) { ?>
            <p class="error"><?= $error ?></p>
            <p class="valid"><?= $valid ?></p>
        <?php } ?>
        <a href="http://[::1]/coiffhair/Welcome" class="retour-button" style="background-color:#0964cc">Retour</a>
    </div>
    <!--  js dans fichier à part -->
    <script>
        showTime();
        availabilities();
    </script>
</body>

</html>