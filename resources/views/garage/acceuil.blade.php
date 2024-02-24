@extends('base')
@section('main')
    <div id="message"
        class="relative w-[90%] md:w-[80%] lg:w-[70%] mx-auto border-2 border-gray-200 p-4 rounded-2xl my-2.5">
        <button class="absolute bottom-0 right-0 rounded-md text-gray-600 border-none bg-transparent p-2"
            onclick="document.getElementById('message').style.display='none'">Cacher</button>
        <h1 class="text-4xl font-bold mb-2">🎉 Bienvenue sur GarageAuto ! 🎉</h1>
        <p class="font-semibold">Nous sommes plus que ravis de vous accueillir dans notre univers dédié à la
            gestion simplifiée et efficace de vos garages. Que vous soyez un propriétaire de garage ou
            un client à la recherche d'un service de garage, notre plateforme est conçue pour répondre à tous vos besoins.
            De la réparation aux services d'entretien, de la peinture à la modification, GarageAuto est votre compagnon de
            choix pour une expérience de garage inoubliable. Cliquez sur 'cacher' pour fermer ce message.</p>

    </div>


    <div class="w-[90%] md:w-[70%] lg:w-[50%] mx-auto border p-2 rounded my-4">
        <div class="input-group flex w-full gap-2">
            <form id="searchForm" action="/search" method="post" class="flex flex-grow gap-2" {{-- onsubmit="submitSearch(event)" --}}>
                @csrf
                <input type="text" name="search" class="form-control border-gray-600" placeholder="Rechercher"
                    aria-label="Rechercher" aria-describedby="basic-addon2">
                <span class="input-group-text bg- border-gray-600 rounded-r-md" id="basic-addon2">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
            </form>

            <button
                class="input-group-text flex justify-center items-center filtre gap1 bg-transparent border-solid hover:bg-purple-950 text-black hover:text-white font-semibold py-2 px-4 border border-purple-950 hover:border-transparent rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                </svg>
                <span class="md:flex hidden">filtre</span>
            </button>

        </div>

        <div class="filtre-items hidden mt-3 justify-between">
            <div class="flex justify-around items-center bg-transparent border-solid hover:bg-purple-950 text-black  hover:text-white px-2 py-1 font-semibold border border-purple-950 hover:border-transparent rounded cursor-pointer min-w-12 gap-x-1"
                id="pop-btn">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>
                <span class="md:flex hidden">popularité</span>
                <div class="flex justify-center items-center w-5 h-full text-gray-600" id="pop-direction">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                    </svg>
                </div>
            </div>

            <div class="flex px-2 py-1 justify-around items-center bg-transparent border-solid hover:bg-purple-950 text-black hover:text-white font-semibold border border-purple-950 hover:border-transparent rounded cursor-pointer min-w-12 gap-x-1"
                id="nom-btn">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span class="md:flex hidden">nom</span>
                <div class="flex justify-center items-center w-5 h-full text-gray-600" id="nom-direction">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                    </svg>
                </div>
            </div>

            <div class="flex px-2 py-1 justify-around items-center bg-transparent border-solid hover:bg-purple-950 text-black hover:text-white font-semibold border border-purple-950 hover:border-transparent rounded cursor-pointer min-w-12 gap-x-1"
                id="lieux-btn">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <span class="md:flex hidden">lieux</span>
                <div class="flex justify-center items-center w-5 h-full text-gray-600" id="lieux-direction">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                    </svg>
                </div>
            </div>

            <div class="flex px-2 py-1 justify-around items-center bg-transparent border-solid hover:bg-purple-950 text-black hover:text-white font-semibold border border-purple-950 hover:border-transparent rounded cursor-pointer min-w-12 gap-x-1"
                id="date-btn">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="md:flex hidden">date</span>
                <div class="flex justify-center items-center w-5 h-full text-gray-600" id="date-direction">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                    </svg>
                </div>
            </div>

            <div class="flex px-2 py-1 justify-around items-center bg-transparent border-solid hover:bg-purple-950 text-black hover:text-white font-semibold border border-purple-950 hover:border-transparent rounded cursor-pointer min-w-12 gap-x-1"
                id="prix-btn">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="md:flex hidden">prix</span>
                <div class="flex justify-center items-center w-5 h-full text-gray-600" id="prix-direction">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-grow px-2 lg:px-4 py-5">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 w-full">

            @foreach ($garages as $donnee)
                <x-body :index="$donnee->id" />
            @endforeach
        </div>
        <div class="flex flex-col items-center mb-10">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Evenements de <span class="font-semibold text-gray-900 ">{{ $garages->firstItem() }}</span> à
                <span class="font-semibold text-gray-900 ">{{ $garages->lastItem() }}</span> sur
                <span class="font-semibold text-gray-900 ">{{ $garages->total() }}</span> Entrées
            </span>
            <div class="inline-flex mt-2 xs:mt-0 gap-4">
                <!-- Buttons -->
                @if ($garages->onFirstPage())
                    <span
                        class="hidden items-center text-gray-700 justify-center px-3 h-8 text-sm font-medium bg-gray-400 rounded-lg hover:bg-gray-500">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Precédent
                    </span>
                @else
                    <a href="{{ $garages->previousPageUrl() }}"
                        class="flex items-center justify-center text-white px-3 py-2 text-sm font-medium bg-gray-900 rounded-lg cursor-pointer outline outline-1 outline-offset-2 outline-blue-800">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Precédent
                    </a>
                @endif

                @if ($garages->hasMorePages())
                    <a href="{{ $garages->nextPageUrl() }}"
                        class="flex items-center justify-center text-white px-3 py-2 text-sm font-medium bg-gray-900 rounded-lg  cursor-pointer outline outline-1 outline-offset-2 outline-blue-800">
                        Suivant
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                @else
                    <span
                        class="hidden items-center text-gray-700 justify-center px-3 h-8 text-sm font-medium bg-gray-400 rounded-lg hover:bg-gray-500">
                        Suivant
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endsection
