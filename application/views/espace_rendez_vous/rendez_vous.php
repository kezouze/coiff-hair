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
    // $now = date('H:i'); // à garder ?
    // $closing = date('17:30');
    ?>
    <div class="container">
        <i>
            <h3>Nous sommes le <?= date('d/m/Y', strtotime($today)) ?> et il est <span id="horloge" onload="showtime()"></span> </h3>
        </i>
        <h2>Nos prochaines disponibilités :</h2>
        <form action="" method="post">
            <input type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>" value="<?= $today ?>">
            <label for="time">Nous sommes ouverts de 09:00 à 17:30</label>
            <select name="time">
                <option value="09:00">09:00</option>
                <option value="09:30">09:30</option>
                <option value="10:00">10:00</option>
                <option value="10:30">10:30</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
                <option value="13:30">13:30</option>
                <option value="14:00">14:00</option>
                <option value="14:30">14:30</option>
                <option value="15:00">15:00</option>
                <option value="15:30">15:30</option>
                <option value="16:00">16:00</option>
                <option value="16:30">16:30</option>
                <option value="17:00">17:00</option>
            </select>
            <textarea placeholder="Racontez-nous votre vie.." maxlength="80" name="details" cols="29" rows="5"></textarea>
            <input type="submit" value="Réserver">
        </form>
        <?php if (isset($error) || isset($valid)) { ?>
            <p><?= $error ?></p>
            <p><?= $valid ?></p>
        <?php }
        // ajouter un auto-refresh toutes les 10 secondes
        ?>
        <a href="/code_igniter_arthur/Users/logged">Retour</a>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
    <script>
        function showTime(){
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    var time = h + ":" + m + ":" + s;
    document.getElementById("horloge").innerText = time;
    document.getElementById("horloge").textContent = time;
    setTimeout(showTime, 1000);
    }
    showTime();
    </script>
</body>

</html>