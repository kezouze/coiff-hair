<!DOCTYPE html>
<html lang="en">

<?php
$title = "Prendre rdv";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <h3>Nous sommes le <span id="today"><?= date('d/m/Y', strtotime($today)) ?></span> et il est <span id="horloge" onload="showtime()"></span> </h3>
            <form action="" method="post">
                <label for="proSelect">Choisissez votre Salon</label>
                <select name="proSelect" id="proSelect">
                    <option disabled selected>✂️</option>
                    <?php foreach ($salons as $salon) { ?>
                        <option value="<?= $salon->id_pro ?>"><?= $salon->name ?></option>
                    <?php } ?>
                </select>
                <label for="date">Choisissez votre date</label>
                <input id="date" type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>">
                <label for="time">Nous sommes ouverts de 09h à 17h30</label>
                <select id="time" name="time">
                    <option>🕙</option>
                    <?php foreach ($creneaux as $creneau) { ?>
                        <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                    <?php } ?>
                </select>
                <label for="details">Renseignez le but de votre visite :)</label>
                <textarea placeholder="..." name="details" cols="29" rows="5" value="..."></textarea>
                <input class="button" type="submit" value="Réserver">
            </form>
            <?php if (isset($error) || isset($valid)) { ?>
                <span class="error">
                    <p><?= $error ?></p>
                </span>
                <span class="valid">
                    <p><?= $valid ?></p>
                </span>
            <?php } ?>
            <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
        </div>
    </div>
    <!--  js dans fichier à part -->
    <script>
        showTime();
        availabilities();
    </script>
</body>

</html>