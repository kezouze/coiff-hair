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

</html>