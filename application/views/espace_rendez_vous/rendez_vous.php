<!DOCTYPE html>
<html lang="en">

<?php
$title = "Prendre rdv";
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <div class="container">
        <i>
            <h3>Nous sommes le <span id="today"><?= date('d/m/Y', strtotime($today)) ?></span> et il est <span id="horloge" onload="showtime()"></span> </h3>
        </i>
        <h2>Nos prochaines disponibilités :</h2>
        <form action="" method="post">
            <input id="date" type="date" name="date" min="<?= $today ?>" max="<?= $aYearLater ?>">
            <label for="time">Nous sommes ouverts de 09h à 17h30</label>
            <select id="time" name="time">
                <?php foreach ($creneaux as $creneau) {
                    if ($creneau !== "indisponible") { ?>
                        <option value="<?= $creneau ?>"><?= substr($creneau, 0, 5) ?></option>
                    <?php } else { ?>
                        <option value="<?= $creneau ?>" disabled><?= ($creneau) ?></option>
                <?php }
                } ?>
            </select>
            <textarea required placeholder="Renseignez le but de votre visite :-)" maxlength="1000" name="details" cols="29" rows="5"></textarea>
            <!-- Le bouton submit devrait être désactivé après un seul clic pour éviter les bugs de doublons. 
            Le required sur input[détails] fait l'affaire pour le moment -->
            <input type="submit" value="Réserver">
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


        var date = new Date();
        var h = date.getHours();
        var m = date.getMinutes();
        var s = date.getSeconds();

        function formatDateToYYYYMMDD(date) {
            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0');
            var day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        formattedDate = formatDateToYYYYMMDD(date);

        // jQuery est importé dans le head.php
        $(document).ready(function() {
            var selectedDate = formattedDate; // Sélectionner la date du jour par défaut
            $('#date').change(function() {
                selectedDate = $(this).val();
                $.ajax({
                    url: "<?php echo base_url('Users/get_available_times'); ?>",
                    type: "POST",
                    data: {
                        date: selectedDate
                    },
                    dataType: "json",
                    success: function(response) {
                        var select = $('#time');
                        select.empty();
                        $.each(response.times, function(index, time) {
                            var option = $('<option></option>').val(time).text(time);
                            var Hour = parseInt(time.substr(0, 2));
                            var Minutes = parseInt(time.substr(3, 2));

                            if (selectedDate === formattedDate) {
                                if (time === "indisponible" || Hour < h || (Hour === h && Minutes <= m)) { // wink wink
                                    option.prop('disabled', true);
                                }
                                select.append(option);
                            } else {
                                if (time === "indisponible") {
                                    option.prop('disabled', true);
                                }
                                select.append(option);
                            }
                        });
                        select.prop('disabled', false); // Réactiver le select après la mise à jour des options
                    },
                    error: function(xhr, status, error) {}
                });
            });
        });
    </script>
</body>

</html>