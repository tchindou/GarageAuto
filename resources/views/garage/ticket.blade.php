{{-- @foreach ($tickets as $ticket)
    <x-ticket :id="$ticket->id" />
@endforeach --}}

@extends('base')
@section('main')
    <div class="flex-grow w-full bg-gray-200 pt-5">
        <div class="flex flex-col relative w-full justify-center">

            @foreach ($tickets as $ticket)
                <x-ticket :id="$ticket->id" />
            @endforeach

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.filtre').click(function() {
                if ($('.filtre-items').hasClass('flex')) {
                    $('.filtre-items').removeClass('flex').addClass('hidden');
                    $('.filtre').removeClass('bg-purple-950');
                } else {
                    $('.filtre-items').removeClass('hidden').addClass('flex');
                    $('.filtre').addClass('bg-purple-950');
                }
            });

            $('[data-dialog-target]').click(function() {
                var target = $(this).attr('data-dialog-target');
                $('[data-dialog="' + target + '"]').parent().addClass(
                    'pointer-events-auto opacity-100');
            });

            $('[data-dialog]').click(function(event) {
                event.stopPropagation();
            });

            $('[data-dialog-backdrop-close="true"]').click(function() {
                $(this).removeClass('pointer-events-auto opacity-100');
            });

            // Au survol de la classe "desc"
            $(".desc").hover(function() {
                // Trouver l'élément "desc-item" lié à cet élément "desc" spécifique
                var descItem = $(this).closest('.flex').find(".desc-item");
                descItem.addClass("flex").removeClass("hidden");
            }, function() {
                // Lorsque le survol se termine, retirer la classe "flex"
                var descItem = $(this).closest('.flex').find(".desc-item");
                descItem.removeClass("flex").addClass("hidden");
            });

            var pressTimer;

            $(".desc").on('mousedown', function() {
                // Commencer le décompte
                pressTimer = window.setTimeout(function() {
                    // Trouver l'élément "desc-item" lié à cet élément "desc" spécifique
                    var descItem = $(this).closest('.flex').find(".desc-item");
                    descItem.addClass("flex").removeClass("hidden");
                }, 1000); // Durée du long press en millisecondes
            }).on('mouseup', function() {
                // Annuler le décompte si le bouton de la souris est relâché avant la fin du décompte
                clearTimeout(pressTimer);
                // Lorsque le press se termine, retirer la classe "flex"
                var descItem = $(this).closest('.flex').find(".desc-item");
                descItem.removeClass("flex").addClass("hidden");
            });

        });
    </script>
@endsection
