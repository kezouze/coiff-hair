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
    $one = 1;
    $tomorrow = date('Y-m-d', strtotime($today. " + $one days"));
    $year = 365;
    $aYearLater = date('Y-m-d', strtotime($today . " + $year days"));
    date_default_timezone_set('Europe/Paris');
    $now = date('H:i');
    $creneaux = ["09:00", "09:30", "10:00", "10:30", "11:00", "11h30", "12:00", 
                 "13:30", "14:00", "14:30", "15:00", "15h30", "16:00", "16:30", "17:00"];
    ?>

    <div class="container">
        <i>
            <h3>Nous sommes le <span id="date"><?= date('d/m/Y', strtotime($today)) ?><br></span> et il est <span id="horloge" onload="showtime()"></span> </h3>
        </i>
        <h2>Nos prochaines disponibilités :</h2>
        <form action="" method="post">
            <input type="date" name="date" min="<?= $tomorrow ?>" max="<?= $aYearLater ?>" value="<?= $tomorrow ?>">
            <label for="time">Nous sommes ouverts de 09:00 à 17:30</label>
            <select name="time">
                <?php foreach($creneaux as $creneau) {
                    // conditions à rajouter, grosse galère sa mère
                    // if($creneau > $now) { ?>
                    <option value="<?= $creneau ?>"><?= $creneau ?></option>
                <?php //} 
                }?>
            </select>
            <textarea required placeholder="Renseignez votre nom, prénom puis le but de votre visite" maxlength="80" name="details" cols="29" rows="5"></textarea>

            <!-- Le bouton submit devrait être désactivé après un seul clic pour éviter les bugs de doublons. Le required sur input[détails] fait l'affaire pour le moment -->
            <input type="submit" value="Réserver">
            <!---------------------------------------------------------------------------------------------->

        </form>

        <?php if (isset($error) || isset($valid)) { ?>
            <p><?= $error ?></p>
            <p><?= $valid ?></p>
        <?php } ?>
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