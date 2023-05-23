<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Rendez-vous</title>
    <link rel="stylesheet" href="/code_igniter_arthur/assets/css/style.css">
</head>

<body>
    <?php
    $today = date('Y-m-d');
    $year = 365;
    $aYearLater = date('Y-m-d', strtotime($today . " + $year days"));
    $now = date('H:i');
    $closing = date('17:30');
    ?>
    <div class="container">
        <h2>Nos prochaines disponibilités :</h2>
        <form action="" method="post">
            <input type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>" value="<?= $today ?>">
            <label for="time">Nous sommes ouverts de 09:00 à 17:30</label>
            <input type="time" name="time" min="<?= $now ?>" max="<?= $closing ?>" value="10:00">
            <textarea placeholder="Racontez-nous votre vie.." maxlength="80" name="details" cols="29" rows="5"></textarea>
            <input type="submit" value="Réserver">
        </form>
        <?php if (isset($error) || isset($valid)) { ?>
            <p><?= $error ?></p>
            <p><?= $valid ?></p>
        <?php } ?>
        <a href="/code_igniter_arthur/Users/logged">Retour</a>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
</body>

</html>