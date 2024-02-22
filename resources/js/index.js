$(document).ready(function () {
        $.ajaxSetup( {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }

                ,
            }

        );

        $(".filtre").click(function () {
                if ($(".filtre-items").hasClass("flex")) {
                    $(".filtre-items").removeClass("flex").addClass("hidden");
                    $(".filtre").removeClass("bg-teal-500");
                }

                else {
                    $(".filtre-items").removeClass("hidden").addClass("flex");
                    $(".filtre").addClass("bg-teal-500");
                }
            }

        );

        $("[data-like-target]").click(function () {
                var target=$(this).attr("data-like-target");
                var index=$(this).attr("data-index");
                var button=$('[data-like-target="'+ target + '"]');

                // Détermine l'URL en fonction de l'état actuel du bouton
                var url=button.hasClass("like-button") ? "/like" : "/unlike";

                $.ajax( {

                        url: url,
                        method: "POST",
                        data: {
                            event_id: index,
                        }

                        ,
                        success: function (response) {
                            // Change l'état du bouton en fonction de la réponse du serveur
                            button.toggleClass("unlike-button like-button");
                            alert("Message : "+ response.message);
                        }

                        ,
                    }

                );
            }

        );

        $("[data-share-target]").click(function () {
                var target=$(this).attr("data-share-target");
                $('[data-share="'+ target + '"]').toggleClass("flex-col hidden");
            }

        );

        $("[data-dialog-target]").click(function () {
                var target=$(this).attr("data-dialog-target");
                $('[data-dialog="'+ target + '"]') .parent() .addClass("pointer-events-auto opacity-100");
            }

        );

        $("[data-dialog]").click(function (event) {
                event.stopPropagation();
            }

        );

        $('[data-dialog-backdrop-close="true"]').click(function () {
                $(this).removeClass("pointer-events-auto opacity-100");
            }

        );

        // Au survol de la classe "desc"
        $(".desc").hover(function () {
                // Trouver l'élément "desc-item" lié à cet élément "desc" spécifique
                var descItem=$(this).closest(".flex").find(".desc-item");
                descItem.addClass("flex").removeClass("hidden");
            }

            ,
            function () {
                // Lorsque le survol se termine, retirer la classe "flex"
                var descItem=$(this).closest(".flex").find(".desc-item");
                descItem.removeClass("flex").addClass("hidden");
            }

        );

        var pressTimer;

        $(".desc") .on("mousedown", function () {

                // Commencer le décompte
                pressTimer=window.setTimeout(function () {
                        // Trouver l'élément "desc-item" lié à cet élément "desc" spécifique
                        var descItem=$(this).closest(".flex").find(".desc-item");
                        descItem.addClass("flex").removeClass("hidden");
                    }

                    , 1000); // Durée du long press en millisecondes
            }

        ) .on("mouseup", function () {
                // Annuler le décompte si le bouton de la souris est relâché avant la fin du décompte
                clearTimeout(pressTimer);
                // Lorsque le press se termine, retirer la classe "flex"
                var descItem=$(this).closest(".flex").find(".desc-item");
                descItem.removeClass("flex").addClass("hidden");
            }

        );

        $("#pop-btn").click(function () {
                if ($("#pop-direction").hasClass("rotate-180")) {
                    $("#pop-direction").removeClass("rotate-180");
                }

                else {
                    reset();
                    $("#pop-direction").addClass("rotate-180");
                }
            }

        );

        $("#nom-btn").click(function () {
                if ($("#nom-direction").hasClass("rotate-180")) {
                    $("#nom-direction").removeClass("rotate-180");
                }

                else {
                    reset();
                    $("#nom-direction").addClass("rotate-180");
                }
            }

        );

        $("#lieux-btn").click(function () {
                if ($("#lieux-direction").hasClass("rotate-180")) {
                    $("#lieux-direction").removeClass("rotate-180");
                }

                else {
                    reset();
                    $("#lieux-direction").addClass("rotate-180");
                }
            }

        );

        $("#date-btn").click(function () {
                if ($("#date-direction").hasClass("rotate-180")) {
                    $("#date-direction").removeClass("rotate-180");
                }

                else {
                    reset();
                    $("#date-direction").addClass("rotate-180");
                }
            }

        );

        $("#prix-btn").click(function () {
                if ($("#prix-direction").hasClass("rotate-180")) {
                    $("#prix-direction").removeClass("rotate-180");
                }

                else {
                    reset();
                    $("#prix-direction").addClass("rotate-180");
                }
            }

        );
    }

);

function reset() {
    $("#pop-direction").removeClass("rotate-180");
    $("#lieux-direction").removeClass("rotate-180");
    $("#nom-direction").removeClass("rotate-180");
    $("#date-direction").removeClass("rotate-180");
    $("#prix-direction").removeClass("rotate-180");
}

// function submitSearch(e) {
//     e.preventDefault();
//     // Exemple d'utilisation d'AJAX avec jQuery
//     $.ajax({
//         type: 'POST',
//         url: '/search',
//         data: $('#searchForm').serialize(), // Envoie les données du formulaire
//         success: function(response) {

//         },
//         error: function(error) {
//             // Gérer les erreurs éventuelles
//         }
//     });
// }