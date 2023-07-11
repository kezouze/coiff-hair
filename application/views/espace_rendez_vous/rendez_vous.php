<!DOCTYPE html>
<html lang="en">

<?php
$title = "Prendre rdv";
require_once(APPPATH . 'views/includes/head.php');
date_default_timezone_set('Europe/Paris');
?>

<body>
    <div class="container">
        <i>
            <h3>Nous sommes le <span id="date"><?= date('d/m/Y', strtotime($today)) ?><br></span> et il est <span id="horloge" onload="showtime()"></span> </h3>
        </i>
        <h2>Nos prochaines disponibilités :</h2>
        <form action="" method="post">
            <input type="date" name="date" min="<?= $tomorrow ?>" max="<?= $aYearLater ?>" value="<?= $tomorrow ?>">
            <label for="time">Nous sommes ouverts de 09h à 17h30</label>
            <select name="time">
                <?php foreach ($creneaux as $creneau) {
                    // conditions à rajouter, grosse galère, aussi dans la partie modif:
                    // if($date == $today && $creneau > $now) { 
                ?>
                    <!-- Ça applique sur tous les jours à partir du lendemain -->
                    <?php if ($creneau !== "indisponible") { ?>
                        <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                    <?php } else { ?>
                        <option value="<?= $creneau ?>" disabled><?= $creneau ?></option>
                <?php }
                } ?>
            </select>
            <textarea required placeholder="Renseignez votre nom, prénom puis le but de votre visite.." maxlength="1000" name="details" cols="29" rows="5"></textarea>

            <!-- Le bouton submit devrait être désactivé après un seul clic pour éviter les bugs de doublons. Le required sur input[détails] fait l'affaire pour le moment -->
            <input type="submit" value="Réserver">
            <!---------------------------------------------------------------------------------------------->

        </form>

        <?php if (isset($error) || isset($valid)) { ?>
            <p class="error"><?= $error ?></p>
            <p class="valid"><?= $valid ?></p>
        <?php } ?>
        <a href="/code_igniter_arthur/Users/logged">Retour</a>
        <a style="color:red" href="/code_igniter_arthur/Users/deconnect">Se déconnecter</a>
    </div>
    <!-- Mettre js dans fichier à part -->
    <script>
        function showTime() {
            var date = new Date();
            var h = date.getHours();
            var m = date.getMinutes();
            var s = date.getSeconds();
            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;
            var time = h + ":" + m;
            document.getElementById("horloge").innerText = time;
            document.getElementById("horloge").textContent = time;
            setTimeout(showTime, 1000);
        }
        showTime();
    </script>
</body>

</html>