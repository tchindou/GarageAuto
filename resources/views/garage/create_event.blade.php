{{-- @foreach ($tickets as $ticket)
    <x-ticket :id="$ticket->id" />
@endforeach --}}

@extends('base')
@section('main')
    <div class="flex-grow w-full">
        <div class="flex flex-col relative w-full justify-center items-center">

            <div class="w-[90%] md:w-[75%] lg:w-[60%] m-2 rounded-lg relative">







                <div class="flex w-full justify-center align-middle">
                    <ul
                        class="flex gap-5 flex-row justify-center items-center w-full py-2 px-1 rounded-md bg-slate-100 shadow-md mb-2">
                        <li class="step-item flex items-center text-base text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-item w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>

                            <span class="ease-in-out duration-500">info personnel</span>
                        </li>
                        <li class="step-item flex items-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-item w-4 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                            <span class="hidden ease-in-out duration-500">info de l'evenement</span>
                        </li>
                        <li class="step-item flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-item w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>

                            <span class="hidden ease-in-out duration-500">images de l'evenement</span>
                        </li>
                        <li class="step-item flex items-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-item w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                            </svg>

                            <span class="hidden ease-in-out duration-500">apercu de l'evenement</span>
                        </li>
                    </ul>
                </div>


                <div id="snackbar" class="hidden py-2 px-1 mb-2">
                    <span class="flex text-center"><span class="text-red-500 font-bold">| </span>Il
                        y a une erreur dans le champ d'entrée</span>
                </div>



                <form autocomplete="off" action="#" id="multistep-form"
                    class="w-full py-2 px-1 rounded-md bg-slate-100 shadow-md mb-2">


                    <div class="overflow-auto">

                        <div class="form-item visible grid grid-cols-1 md:grid-cols-2 gap-5 px-2">

                            <div class="relative w-full">
                                <div>
                                    <label for="nom_org" class="font-medium">Votre nom</label>
                                    <input autocomplete="new-password" type="text"
                                        class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                        id="nom_org" placeholder="John" />
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red"
                                    class="errorIcon absolute end-2 bottom-0 m-1 h-6 w-6 hidden" id="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>

                            </div>

                            <div class="relative w-full">
                                <div>
                                    <label for="prenom_org" class="font-medium">Votre prenom</label>
                                    <input autocomplete="new-password" type="text"
                                        class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                        id="prenom_org" placeholder="Doe" />
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red"
                                    class="errorIcon absolute end-2 bottom-0 m-1 h-6 w-6 hidden" id="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>

                            </div>

                            <div class="relative w-full">
                                <div>
                                    <label for="email_org" class="font-medium">Votre email</label>
                                    <input autocomplete="new-password" type="email"
                                        class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                        id="nom_org" placeholder="example: 5HJqI@example.com" />
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red"
                                    class="errorIcon absolute end-2 bottom-0 m-1 h-6 w-6 hidden" id="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>

                            </div>

                            <div class="relative w-full">
                                <div>
                                    <label for="tel_org" class="font-medium">Telephone</label>
                                    <input autocomplete="new-password" type="tel"
                                        class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                        id="nom_org" placeholder="example: 22822222222" />
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="red"
                                    class="errorIcon absolute end-2 bottom-0 m-1 h-6 w-6 hidden" id="">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>

                            </div>

                            <div class="relative w-full">
                                <label for="pwd_org" class="font-medium">Mot de passe</label>
                                <input type="password"
                                    class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                    id="pwd_org" placeholder="Votre mot de passe" />
                            </div>

                            <div class="relative w-full">
                                <label for="cpwd_org" class="font-medium">Confirmer</label>
                                <input type="password"
                                    class="form-input inputField bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 border-solid"
                                    id="cpwd_org" placeholder="Confirmer mot de passe" />
                            </div>

                        </div>





                        <div class="form-item grid-cols-1 md:grid-cols-2 gap-5 px-2">
                            <textarea id="content" name="content" class="border-2 border-gray-500" placeholder="Entrer votre description...">
                                
                            </textarea>

                        </div>




                        <div class="form-item">
                            <span class="text-base text-gray-800 font-medium mb-4">Step 3: Event Images</span>

                        </div>





                        <div class="form-item">
                            <span class="text-base text-gray-800 font-medium mb-4">Step 4: Event Preview</span>

                        </div>


                    </div>





                    <div class="button-container flex justify-between mt-5">
                        <div>
                            <button type="button" id="previousBtn"
                                class="px-2 py-1 mr-2 hover:border-purple-950 active:bg-teal-300 border-gray-500 rounded-md border-solid">Precedent</button>

                        </div>
                        <div>
                            <input type="submit" value="Submit"
                                class="px-2 py-1 mr-2 focus:border-purple-950 hover:border-purple-950 focus:bg-teal-300 border-gray-500 rounded-md border-solid">
                            <button type="button" id="nextBtn"
                                class="px-2 py-1 mr-2 hover:border-purple-950 active:bg-teal-300 rounded-md border-gray-500 border-solid">Suivant</button>

                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>














    <!-- Assurez-vous d'inclure jQuery avant d'ajouter ce script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: ['bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList', 'indent',
                    'outdent'
                ],
                placeholder: "Entrez votre texte ici...",

            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function() {
            // Initialisation : masquer tous les éléments sauf le premier
            $(".form-item:not(:first)").addClass("hidden");
            $(".step-item:first").addClass("text-blue-700 gap-1").removeClass("text-gray-700");
            $("input[type='submit']").hide();
            $("#previousBtn").hide();

            // Clic sur le bouton "Next"
            $("#nextBtn").click(function() {
                var currentStep = $(".form-item:visible");
                var nextStep = currentStep.next(".form-item");

                // Mettre à jour l'affichage des étapes
                $(".step-item span").addClass("hidden");
                var nextStepIndex = $(".form-item").index(nextStep);
                $(".step-item:eq(" + nextStepIndex + ")").find("span").removeClass("hidden");

                $(".form-item").removeClass("grid").addClass("hidden");
                nextStep.addClass("grid").removeClass("hidden");

                // Afficher le bouton "Previous" après le premier clic sur "Next"
                $("#previousBtn").show();

                // Si c'est la dernière étape, masquer le bouton "Next" et afficher le bouton "Submit"
                if (nextStep.is(":last-child")) {
                    $("#nextBtn").hide();
                    $("input[type='submit']").show();
                }

                // Mettre à jour l'indicateur d'étape
                $(".step-item:eq(" + $(".form-item:visible").index(".form-item") + ")").addClass(
                    "text-blue-700 gap-1").removeClass("text-gray-700");
            });

            // Clic sur le bouton "Previous"
            $("#previousBtn").click(function() {
                var currentStep = $(".form-item:visible");
                var prevStep = currentStep.prev(".form-item");

                // Mettre à jour l'affichage des étapes
                $(".step-item span").addClass("hidden");
                var prevStepIndex = $(".form-item").index(prevStep);
                $(".step-item:eq(" + prevStepIndex + ")").find("span").removeClass("hidden");

                $(".form-item").removeClass("grid").addClass("hidden");
                prevStep.addClass("grid").removeClass("hidden");

                // Si c'est la première étape, masquer le bouton "Previous"
                if (prevStep.is(":first-child")) {
                    $("#previousBtn").hide();
                }

                // Afficher le bouton "Next" et masquer le bouton "Submit"
                $("#nextBtn").show();
                $("input[type='submit']").hide();

                // Mettre à jour l'indicateur d'étape
                $(".step-item:eq(" + $(".form-item:visible").index(".form-item") + ")").addClass(
                    "text-blue-700 gap-1").removeClass("text-gray-700");
            });

            var inputField = $('#inputField');
            var errorIcon = $('#errorIcon');
            var snackbar = $('#snackbar');

            inputField.on('input', function() {
                if (inputField.val() ===
                    '0000') { // Remplacez cette condition par votre propre logique de validation
                    errorIcon.removeClass('hidden');
                } else {
                    errorIcon.addClass('hidden');
                }
            });

            errorIcon.on('click', function() {
                snackbar.removeClass('hidden');
                setTimeout(function() {
                    snackbar.addClass('hidden');
                }, 3000); // Le message Snackbar disparaît après 3 secondes
            });
        });
    </script>
@endsection
