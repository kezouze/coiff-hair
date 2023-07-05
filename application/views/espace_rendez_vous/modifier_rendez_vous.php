<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier votre rdv";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <?php
    $today = date('Y-m-d');
    $one = 1;
    $tomorrow = date('Y-m-d', strtotime($today . " + $one days"));
    $year = 365;
    $aYearLater = date('Y-m-d', strtotime($today . " + $year days"));
    date_default_timezone_set('Europe/Paris');
    $now = date('H:i');
    $creneaux = [
        "09:00", "09:30", "10:00", "10:30", "11:00", "11h30", "12:00",
        "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00"
    ];
    ?>
    <div class="container">
        <h3>Modifier votre rendez-vous du ...</h3>
        <form action="" method="post">
            <label for="date">Votre nouvelle date :</label>
            <input type="date" name="date" min="<?= $tomorrow ?>" max="<?= $aYearLater ?>" value="<?= $tomorrow ?>">
            <label for="time">Nous sommes ouverts de 09h à 17h30</label>
            <select name="time">
                <?php foreach ($creneaux as $creneau) {
                    // conditions à rajouter:
                    // if($date == $today && $creneau > $now) { 
                ?>
                    <option value="<?= $creneau ?>"><?= $creneau ?></option>
                <?php //} 
                } ?>
            </select>
            <input type="submit" value="Modifier">
        </form>
        <?php if (isset($error) || isset($valid)) { ?>
            <p><?= $error ?></p>
            <p><?= $valid ?></p>
        <?php } ?>
        <a href="/code_igniter_arthur/Users/logged">Annuler</a>
    </div>
</body>

</html>