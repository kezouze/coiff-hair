<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier votre rdv";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <i>
            <h3>Modifier votre rendez-vous du :<br><b style="color:#ff7f00; font-size:30px;"><?= date('d/m/Y', strtotime($date)) ?></b> à <b style="color:#ff7f00; font-size:30px;"><?= substr($time, 0, 5) ?></b></h3>
        </i>
        <form action="" method="post">
            <label for="date">Votre nouvelle date :</label>
            <input id="date" type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>">
            <label for="time">Nous sommes ouverts de 09h à 17h30</label>
            <select id="time" name="time">
                <?php foreach ($creneaux as $creneau) {
                    if ($creneau !== "indisponible") { ?>
                        <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                <?php }
                } ?>
            </select>
            <textarea required maxlength="1000" name="details" cols="29" rows="5"><?= $details ?></textarea>
            <!-- Le bouton submit devrait être désactivé après un seul clic pour éviter les bugs de doublons. 
            Le required sur input[détails] fait l'affaire pour le moment -->
            <input type="submit" value="Modifier">
        </form>
        <?php if (isset($error) || isset($valid)) { ?>
            <p class="error"><?= $error ?></p>
            <p class="valid"><?= $valid ?></p>
        <?php } ?>
        <a href="/code_igniter_arthur/Users/logged">Annuler</a>
    </div>
</body>
<script>
    availabilities();
</script>

</html>