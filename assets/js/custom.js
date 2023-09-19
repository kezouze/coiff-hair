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

function availabilities(selectedPro) {
    // version chatGpt:
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


    $(document).ready(function () {
        $('#proSelect').change(function () {
            selectedPro = parseInt($(this).val());
            updateAvailableTimes();
        });

        $('#date').change(function () {
            updateAvailableTimes();
        });

        // La fonction est appelée au changement de professionnel ou de la date
        function updateAvailableTimes() {
            var selectedDate = formatDateToYYYYMMDD(new Date($('#date').val()));
            $.ajax({
                // fonction située dans le contrôleur Users, get_available_times()
                url: "http://[::1]/coiffhair/Users/get_available_times",
                type: "POST",
                // données envoyées
                data: {
                    date: selectedDate,
                    pro: selectedPro
                },
                dataType: "json",

                // si la requête réussit, on récupère la réponse
                success: function (response) {
                    // on vide la liste des créneaux
                    var select = $('#time');
                    select.empty();
                    $.each(response.times, function (index, time) {
                        // on insère dans notre select une option pour chaque créneau
                        var option = $('<option></option>').val(time).text(time);
                        var hour = parseInt(time.substr(0, 2));
                        var minutes = parseInt(time.substr(3, 2));

                        if (selectedDate === formatDateToYYYYMMDD(date)) {
                            // si l'heure est passée
                            if (time === "indisponible" || hour < h || (hour === h && minutes <= m)) {
                                // on désactive l'option
                                option.prop('disabled', true);
                            }
                            select.append(option);
                        } else {
                            // si le créneau est indiqué comme indisponible
                            if (time === "indisponible") {
                                option.prop('disabled', true);
                            }
                            select.append(option);
                        }
                    });
                    // sinon l'option est clickable
                    select.prop('disabled', false);
                },
                error: function (xhr, status, error) { }
            });
        }
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

function updateLikes() {
    $(document).ready(function () {
        $('.likes').on('click', function () {
            var nbLikes = parseInt(document.getElementById('likes').innerHTML);
            var id = $(this).data('id')
            var likeBtn = $(this)
            $.ajax({
                url: "http://[::1]/coiffhair/Welcome/likes",
                type: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {
                    nbLikes = response.likes;
                    if (response.redirect) {
                        window.location.href = "http://[::1]/coiffhair/Users/";
                    }
                    if (response.color) {
                        $(likeBtn).css('background-color', response.color)
                    }
                    document.getElementById('likes').innerHTML = nbLikes;
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            })
        })
    })
}