<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }} ">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col min-h-screen overflow-x-hidden justify-between">
    <!--Pertit faite avec bootstrap-->
    <nav
        class="w-full flex justify-between items-center md:h-16 nav-bar mb-5 bg-white border-0 relative px-2 z-50 py-2">

        <div class="flex items-center justify-between px-4 w-full">
            <div class="">
                <a href="/" class=" flex items-center fs-5 ">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="imglogo"><span>GarageAuto</span>
                </a>
            </div>

            <div class="flex  md:hidden" id="toggler">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
        </div>
        <ul class="hidden md:flex flex-col-reverse rounded-2xl text-md md:text-base md:items-center justify-end md:flex-row w-[60%] lg:w-[60%] md:w-full  py-1 px-2 md:p-0 md:px-4 gap-4 absolute top-20  md:relative md:top-auto md:right-auto bg-inherit md:h-full shadow-md md:shadow-none"
            id="links">

            <li class="flex flex-nowrap items-center min-h-4">
                <a class="flex flex-nowrap items-center gap-2" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 flex ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <span class="flex">Mes interventions</span>
                </a>
            </li>
            <li class="flex flex-nowrap items-center justify-center py-1 md:py-1 h-2/3 md:h-auto">
                <a class="flex flex-nowrap items-center" aria-disabled="true" href="#">
                    <div class="flex gap-2.5">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="h-full w-8 md:w-5 md:h-5 outline outline-1 outline-offset-4 outline-black rounded-full">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
    <!--Fin de la partie faite avec bootstrap-->
    @yield('main')

    <footer class="flex flex-col-reverse md:flex-row justify-around gap-2">
        <div class="flex items-center justify-center text-xs">
            <p>Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2023 GarageAuto</p>
        </div>
        <div class="flex px-1 items-center justify-around md:text-sm text-xs">
            <div class="flex px-1"><a href="">A
                    propos</a></div>
            <div class="flex px-1"><a href="">Centre
                    d'aide</a></div>
            <div class="flex px-1"><a href="">Termes</a>
            </div>
            <div class="flex px-1"><a href="">Politique
                    de confidentialité</a></div>
        </div>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite('resources/js/index.js')
<script>
    $(document).ready(function() {
        $('#toggler').click(function() {
            if ($('#links').hasClass('-right-full')) {
                $('#links').removeClass('-right-full');
                $('#links').removeClass('hidden');
                $('#links').addClass('right-0');
                $('#links').addClass('flex');
            } else {
                $('#links').removeClass('right-0');
                $('#links').removeClass('flex');
                $('#links').addClass('-right-full');
                $('#links').addClass('hidden');
            }
        });
    });
</script>

</html>
