@extends('base')
@section('main')
    @php
        // Utilisez le modèle et l'index pour récupérer les données correspondantes de la base de données
        $data = \App\Models\Garage::find($eventId);
        $images = json_decode($data->images, true); // Convertit la chaîne JSON en tableau
        $index = $eventId;
    @endphp

    <div class="overflow-y-auto inset-0 grid h-full w-full mb-10 place-items-center transition-opacity duration-300">
        <div
            class="relative m-4 min-w-[90%] sm:min-w-[90%] sm:max-w-[90%] md:min-w-[80%] md:max-w-[80%] lg:min-w-[70%] lg:max-w-[70%] max-w-[90%]  rounded-lg bg-white font-sans text-base font-light leading-relaxed antialiased shadow-2xl">


            <div
                class="relative border-t border-b border-t-blue-100 border-b-blue-100 p-0  rounded-t-lg font-sans text-base font-light leading-relaxed antialiased">
                <img alt="nature"
                    class="h-[10rem] sm:h-[100px] md:h-[200px] lg:h-[250px] w-full object-cover object-center  rounded-t-lg"
                    src="{{ isset($images['img1']) ? $images['img1'] : 'default_image.jpg' }}" />

                <div class="flex flex-col justify-end bg-black bg-opacity-50 absolute inset-0 h-full w-full px-1 py-1">
                    <span class="md:text-4xl sm:text-3xl text-2xl text-white mb-3">{{ $data->nom }}</span>

                </div>
            </div>
            <div class="flex flex-col items-start gap-1 p-4">

                <div class="flex flex-row w-full justify-end gap-3 mb-5">
                    <button
                        class="bg-transparent border-solid hover:bg-teal-500 text-black font-semibold p-1 border border-teal-500 hover:border-transparent rounded">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>


                        Payer le ticket

                    </button>

                    <button data-like-target="like-{{ $eventId }}" data-index="{{ $eventId }}"
                        class="like-button flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button" data-ripple-dark="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>

                    <button id="shareBtn" data-share-target="share-{{ $eventId }}"
                        class="flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button" data-ripple-dark="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                            class="h-4 w-4">
                            <path fill-rule="evenodd"
                                d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Partager
                    </button>
                </div>

                <div class="share-options hidden w-full my-10 justify-evenly" data-share="share-{{ $index }}">
                    Partager
                    <div class="flex w-full bg-slate-100 p-1 border-1 rounded-lg justify-evenly mt-2 mr-3 border-gray-800">
                        <div class="w-[90%]"><span>http://127.0.0.1:8000/event/create/?desc={{ $index }}</span>
                        </div>
                        <button
                            class="flex select-none items-center gap-3  rounded-lg border border-gray-600 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Copier</button>
                    </div>
                    <div class="flex w-full border rounded-lg justify-evenly">
                        <a href="https://wa.me/?text=http://127.0.0.1:8000/event/create/?desc={{ $index }}"
                            target="_blank"
                            class="items-center flex mt-2 text-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">
                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="#26AF74" x="238.5" y="238.5"
                                role="img" style="display:inline-block;vertical-align:middle"
                                xmlns="http://www.w3.org/2000/svg">
                                <g fill="#26AF74">
                                    <path fill="currentColor"
                                        d="M8.886 7.17c.183.005.386.015.579.443c.128.285.343.81.519 1.238c.137.333.249.607.277.663c.064.128.104.275.02.448l-.028.058a1.43 1.43 0 0 1-.23.37a9.386 9.386 0 0 0-.143.17c-.085.104-.17.206-.242.278c-.129.128-.262.266-.114.522c.149.256.668 1.098 1.435 1.777a6.634 6.634 0 0 0 1.903 1.2c.07.03.127.055.17.076c.257.128.41.108.558-.064c.149-.173.643-.749.817-1.005c.168-.256.34-.216.578-.128c.238.089 1.504.71 1.761.837l.143.07c.179.085.3.144.352.23c.064.109.064.62-.148 1.222c-.218.6-1.267 1.176-1.742 1.22l-.135.016c-.436.052-.988.12-2.956-.655c-2.426-.954-4.027-3.32-4.35-3.799a2.768 2.768 0 0 0-.053-.076l-.006-.008c-.147-.197-1.048-1.402-1.048-2.646c0-1.19.587-1.81.854-2.092l.047-.05a.95.95 0 0 1 .687-.32c.173 0 .347 0 .495.005Z" />
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M2.184 21.331a.4.4 0 0 0 .487.494l4.607-1.204a10 10 0 0 0 4.76 1.207h.004c5.486 0 9.958-4.447 9.958-9.912a9.828 9.828 0 0 0-2.914-7.011A9.917 9.917 0 0 0 12.042 2c-5.486 0-9.958 4.446-9.958 9.911c0 1.739.458 3.447 1.33 4.954l-1.23 4.466Zm2.677-4.068a1.5 1.5 0 0 0-.148-1.15a8.377 8.377 0 0 1-1.129-4.202c0-4.63 3.793-8.411 8.458-8.411c2.27 0 4.388.877 5.986 2.468a8.328 8.328 0 0 1 2.472 5.948c0 4.63-3.793 8.412-8.458 8.412h-.005a8.5 8.5 0 0 1-4.044-1.026a1.5 1.5 0 0 0-1.094-.132l-2.762.721l.724-2.628Z"
                                        clip-rule="evenodd" />
                                </g>
                            </svg>

                            <span class="hidden md:flex text-gray-800 ml-2">WhatsApp</span>
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=http://127.0.0.1:8000/event/create/?desc={{ $index }}"
                            target="_blank"
                            class="items-center flex mt-2 text-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">

                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="#3A76F5" x="238.5" y="238.5"
                                role="img" style="display:inline-block;vertical-align:middle"
                                xmlns="http://www.w3.org/2000/svg">
                                <g fill="#3A76F5">
                                    <g fill="none">
                                        <g clip-path="url(#akarIconsFacebookFill0)">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M0 12.067C0 18.033 4.333 22.994 10 24v-8.667H7V12h3V9.333c0-3 1.933-4.666 4.667-4.666c.866 0 1.8.133 2.666.266V8H15.8c-1.467 0-1.8.733-1.8 1.667V12h3.2l-.533 3.333H14V24c5.667-1.006 10-5.966 10-11.933C24 5.43 18.6 0 12 0S0 5.43 0 12.067Z"
                                                clip-rule="evenodd" />
                                        </g>
                                        <defs>
                                            <clipPath id="akarIconsFacebookFill0">
                                                <path fill="#fff" d="M0 0h24v24H0z" />
                                            </clipPath>
                                        </defs>
                                    </g>
                                </g>
                            </svg>

                            <span class="hidden md:flex text-gray-800 ml-2">Facebook</span>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=http://127.0.0.1:8000/event/create/?desc={{ $index }}"
                            target="_blank"
                            class="items-center flex mt-2 text-blue-400 hover:bg-blue-700 font-bold py-2 px-4 rounded">

                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="#3A76F5" x="238.5" y="238.5"
                                role="img" style="display:inline-block;vertical-align:middle"
                                xmlns="http://www.w3.org/2000/svg">
                                <g fill="#3A76F5">
                                    <path fill="currentColor"
                                        d="M23.643 4.937c-.835.37-1.732.62-2.675.733a4.67 4.67 0 0 0 2.048-2.578a9.3 9.3 0 0 1-2.958 1.13a4.66 4.66 0 0 0-7.938 4.25a13.229 13.229 0 0 1-9.602-4.868c-.4.69-.63 1.49-.63 2.342A4.66 4.66 0 0 0 3.96 9.824a4.647 4.647 0 0 1-2.11-.583v.06a4.66 4.66 0 0 0 3.737 4.568a4.692 4.692 0 0 1-2.104.08a4.661 4.661 0 0 0 4.352 3.234a9.348 9.348 0 0 1-5.786 1.995a9.5 9.5 0 0 1-1.112-.065a13.175 13.175 0 0 0 7.14 2.093c8.57 0 13.255-7.098 13.255-13.254c0-.2-.005-.402-.014-.602a9.47 9.47 0 0 0 2.323-2.41l.002-.003Z" />
                                </g>
                            </svg>

                            <span class="hidden md:flex text-gray-800 ml-2">Twitter</span>
                        </a>

                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=http://127.0.0.1:8000/event/create/?desc={{ $index }}&title=TITRE_DE_L_ARTICLE&summary=RESUME_DE_L_ARTICLE&source=SOURCE"
                            target="_blank"
                            class="items-center flex mt-2 text-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">

                            <svg width="35px" height="35px" viewBox="0 0 24 24" fill="#3A76F5" x="238.5" y="238.5"
                                role="img" style="display:inline-block;vertical-align:middle"
                                xmlns="http://www.w3.org/2000/svg">
                                <g fill="#3A76F5">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M1 2.838A1.838 1.838 0 0 1 2.838 1H21.16A1.837 1.837 0 0 1 23 2.838V21.16A1.838 1.838 0 0 1 21.161 23H2.838A1.838 1.838 0 0 1 1 21.161V2.838Zm8.708 6.55h2.979v1.496c.43-.86 1.53-1.634 3.183-1.634c3.169 0 3.92 1.713 3.92 4.856v5.822h-3.207v-5.106c0-1.79-.43-2.8-1.522-2.8c-1.515 0-2.145 1.089-2.145 2.8v5.106H9.708V9.388Zm-5.5 10.403h3.208V9.25H4.208v10.54ZM7.875 5.812a2.063 2.063 0 1 1-4.125 0a2.063 2.063 0 0 1 4.125 0Z"
                                        clip-rule="evenodd" />
                                </g>
                            </svg>

                            <span class="hidden md:flex text-gray-800 ml-2">Linkedin</span>
                        </a>

                        <a href="mailto:?subject=Sujet&body=http://127.0.0.1:8000/event/create/?desc={{ $index }}"
                            class="items-center flex mt-2 text-yellow-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">

                            <svg width="35px" height="35px" viewBox="0 0 1024 1024" fill="#E4AB00" x="238.5"
                                y="238.5" role="img" style="display:inline-block;vertical-align:middle"
                                xmlns="http://www.w3.org/2000/svg">
                                <g fill="#E4AB00">
                                    <path fill="currentColor"
                                        d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5l39.3-50.5l42.8 33.3h643.1l42.8-33.3l39.3 50.5l-27.7 21.5zM833.6 232L512 482L190.4 232l-42.8-33.3l-39.3 50.5l27.6 21.5l341.6 265.6a55.99 55.99 0 0 0 68.7 0L888 270.8l27.6-21.5l-39.3-50.5l-42.7 33.2z" />
                                </g>
                            </svg>

                            <span class="hidden md:flex text-gray-800 ml-2">Mail</span>
                        </a>
                    </div>
                </div>

                <div class=" mb-5">
                    <div>
                        <span
                            class="text-base md:text-lg font-medium border-l-yellow-500 border-solid border-transparent  border-l-2 pl-1">Description</span>

                    </div>
                    <div class=" pl-3">
                        <p class="md:text-base line-clamp-3">{{ $data->description }}. Lorem, ipsum dolor sit amet
                            consectetur
                            adipisicing elit. Modi sapiente beatae sint autem? Nostrum excepturi nihil eos sequi cupiditate
                            tempora natus praesentium ullam laborum, ad libero ipsa eum suscipit animi!</p>
                    </div>
                </div>

                <div class="gap-3 mb-5">
                    <span
                        class="text-base md:text-lg font-medium border-l-orange-500 border-solid border-transparent  border-l-2 pl-1">Lieu
                        :</span>

                    <span class="text-base md:text-lg text-underline"><a href="#">{{ $data->lieu }}</a></span>
                </div>

                <div class="gap-3 mb-5">
                    <span
                        class="text-base md:text-lg font-medium border-l-orange-500 border-solid border-transparent  border-l-2 pl-1">Date
                        et Heure
                        :</span>

                    <span class="text-base md:text-lg text-underline">{{ $data->dateEvenement }}</span>
                </div>

                <div class=" mb-5">
                    <div>
                        <span
                            class="text-base md:text-lg font-medium border-l-yellow-500 border-solid border-transparent  border-l-2 pl-1">Condition
                            supplementaire</span>

                    </div>
                    <div class=" pl-3">
                        <p class="md:text-base line-clamp-3">Lorem, ipsum dolor sit amet
                            consectetur
                            adipisicing elit. Modi sapiente beatae sint autem? Nostrum excepturi nihil eos sequi cupiditate
                            tempora natus praesentium ullam laborum, ad libero ipsa eum suscipit animi!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
