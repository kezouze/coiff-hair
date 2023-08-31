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

// function availabilities() {

//     // si je ne duplique pas, ça bugue 
//     var date = new Date();
//     var h = date.getHours();
//     var m = date.getMinutes();
//     var s = date.getSeconds();
//     var selectedPro = $('#proSelect').val();


//     function formatDateToYYYYMMDD(date) {
//         var year = date.getFullYear();
//         var month = String(date.getMonth() + 1).padStart(2, '0');
//         var day = String(date.getDate()).padStart(2, '0');
//         return `${year}-${month}-${day}`;
//     }
//     formattedDate = formatDateToYYYYMMDD(date);

//     // jQuery est importé dans le head.php
//     $(document).ready(function () {
//         var selectedDate = formattedDate; // Sélectionner la date du jour par défaut
//         $('#proSelect').change(function () {
//             selectedPro = parseInt($(this).val());
//             console.log(selectedPro);
//             $('#date').change(function () {
//                 selectedDate = $(this).val();
//                 console.log(selectedDate);
//                 $.ajax({
//                     url: "http://[::1]/coiffhair/Users/get_available_times",
//                     type: "POST",
//                     data: {
//                         date: selectedDate,
//                         pro: selectedPro
//                     },
//                     dataType: "json",
//                     success: function (response) {
//                         var select = $('#time');
//                         select.empty();
//                         $.each(response.times, function (index, time) {
//                             var option = $('<option></option>').val(time).text(time);
//                             var hour = parseInt(time.substr(0, 2));
//                             var minutes = parseInt(time.substr(3, 2));

//                             if (selectedDate === formattedDate) {
//                                 if (time === "indisponible" || hour < h || (hour === h && minutes <= m)) {
//                                     option.prop('disabled', true);
//                                 }
//                                 select.append(option);
//                             } else {
//                                 if (time === "indisponible") {
//                                     option.prop('disabled', true);
//                                 }
//                                 select.append(option);
//                             }
//                         });
//                         select.prop('disabled', false);
//                     },
//                     error: function (xhr, status, error) { }
//                 });
//             });
//         });
//     });
// }

function availabilities() {
    // version chatGpt:
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();
    var selectedPro = $('#proSelect').val();

    function formatDateToYYYYMMDD(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // jQuery est importé dans le head.php
    $(document).ready(function () {
        $('#proSelect').change(function () {
            selectedPro = parseInt($(this).val());
            updateAvailableTimes();
        });

        $('#date').change(function () {
            updateAvailableTimes();
        });

        function updateAvailableTimes() {
            var selectedDate = formatDateToYYYYMMDD(new Date($('#date').val()));
            $.ajax({
                url: "http://[::1]/coiffhair/Users/get_available_times",
                type: "POST",
                data: {
                    date: selectedDate,
                    pro: selectedPro
                },
                dataType: "json",
                success: function (response) {
                    var select = $('#time');
                    select.empty();
                    $.each(response.times, function (index, time) {
                        var option = $('<option></option>').val(time).text(time);
                        var hour = parseInt(time.substr(0, 2));
                        var minutes = parseInt(time.substr(3, 2));

                        if (selectedDate === formatDateToYYYYMMDD(date)) {
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
            nbLikes++;
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
                    if (response.color === 'green') {
                        $('.likes[data-id="' + id + '"]').removeClass('not-liked').addClass('liked');
                    }
                    if (response.color === 'red') {
                        $('.likes[data-id="' + id + '"]').removeClass('liked').addClass('not-liked');
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