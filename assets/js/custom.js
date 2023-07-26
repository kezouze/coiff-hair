function showTime() {
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    var time = h + "h" + m;
    document.getElementById("horloge").innerText = time;
    document.getElementById("horloge").textContent = time;
    setTimeout(showTime, 1000);
}

function availabilities() {

    // si je ne duplique pas, ça bugue 
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
    $(document).ready(function () {
        var selectedDate = formattedDate; // Sélectionner la date du jour par défaut
        $('#date').change(function () {
            selectedDate = $(this).val();
            $.ajax({
                url: "http://[::1]/code_igniter_arthur/Users/get_available_times",
                type: "POST",
                data: {
                    date: selectedDate
                },
                dataType: "json",
                success: function (response) {
                    var select = $('#time');
                    select.empty();
                    $.each(response.times, function (index, time) {
                        var option = $('<option></option>').val(time).text(time);
                        var hour = parseInt(time.substr(0, 2));
                        var minutes = parseInt(time.substr(3, 2));

                        if (selectedDate === formattedDate) {
                            if (time === "indisponible" || hour < h || (hour === h && minutes <= m)) {
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
                    select.prop('disabled', false);
                },
                error: function (xhr, status, error) { }
            });
        });
    });
}

function toggleButton() {
    $(document).ready(function () {
        $("#toggleButton").click(function () {
            $(".ligne2").toggle();
            // on change le texte du bouton :
            var buttonText = $(".ligne2").is(":visible") ? "Cacher mes rendez-vous passés" : "Voir mes rendez-vous passés";
            $(this).text(buttonText);

        });
    });
}