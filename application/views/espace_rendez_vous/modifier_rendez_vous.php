<!DOCTYPE html>
<html lang="fr">

<?php
$title = "Modifier votre rdv";
$color = "#0964cc";
$linkTo = "Users";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="blur">
        <?php require_once(APPPATH . 'views/includes/header.php'); ?>
        <div class="content">
            <?php foreach ($details as $detail) {
                $id_pro = $detail->id_pro; ?>
                <h3>Modifier votre rendez-vous du :<br><b class="modify-rdv"><?= date('d/m', strtotime($detail->date_rendez_vous)) ?></b> à <b class="modify-rdv"><?= substr($detail->heure_rendez_vous, 0, 5) ?></b> chez <a href="/coiffhair/Welcome/infos?id=<?= $detail->id_pro ?>"></a><b class="modify-rdv"><?= $detail->name ?></b></h3>
                <form action="" method="post">
                    <label for="date">Votre nouvelle date :</label>
                    <input id="date" type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>">
                    <label for="time">Nous sommes ouverts de 09h à 17h30</label>
                    <select id="time" name="time">
                        <option>🕙</option>
                        <?php foreach ($creneaux as $creneau) { ?>
                            <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                        <?php } ?>
                    </select>
                    <label for="details">Modifier si besoin le but de votre visite</label>
                    <textarea required maxlength="1000" name="details" cols="29" rows="5"><?= $detail->details_rendez_vous ?></textarea>
                    <input class="button" type="submit" value="Modifier">
                </form>
            <?php } ?>
            <?php if (isset($error) || isset($valid)) { ?>
                <p class="error"><?= $error ?></p>
                <p class="valid"><?= $valid ?></p>
            <?php } ?>
        </div>
        <?php require_once(APPPATH . 'views/includes/footer.php'); ?>
    </div>
</body>
<script>
    var selectedPro = parseInt(<?= $id_pro; ?>)
    availabilities(selectedPro);
</script>

</html>