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
                <select id="proSelect" name="proSelect">
                    <?php if (isset($_GET['id'])) { ?>
                        <option value="<?= $_GET['id'] ?>"><?= $_GET['name'] ?></option>
                    <?php } else { ?>
                        <option disabled selected>✂️</option>
                        <?php foreach ($salons as $salon) { ?>
                            <?php if (!$salon->is_on_holidays) { ?>
                                <option value="<?= $salon->id_pro ?>"><?= $salon->name ?></option>
                            <?php } else { ?>
                                <option disabled><?= $salon->name ?> - en vacances 🏖️ </option>
                            <?php } ?>
                    <?php }
                    } ?>
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
                <label for="details">Renseignez le but de votre visite 😊</label>
                <textarea placeholder="..." id="details" name="details" cols="29" rows="5"><?= set_value('details') ?></textarea>
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
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
    <!--  js dans fichier à part -->
    <script>
        showTime();
        var selectedPro = parseInt($('#proSelect').val());
        availabilities(selectedPro);
    </script>
</body>

</html>