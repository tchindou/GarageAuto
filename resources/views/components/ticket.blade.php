@php
    // $reservation = \App\Models\Reservation::find($id);
    // $event = \App\Models\Evenement::find($reservation->evenement_id);
    // $place = \App\Models\Place::find($reservation->place_id);
    // $user = \App\Models\User::find($reservation->user_id);
    // $data = $event;
@endphp


{{-- {{ $ticket->reservation_id }} | {{ $ticket->nombre }} | {{ $ticket->id }}
    {{ $event->nom }} | {{ $event->lieu }} | {{ $event->dateEvenement }} --}}

<div
    class='desc  container relative flex h-fit sm:min-h-32 m-auto md:mb-4 lg:mb-6  flex-col overflow-hidden w-[96%] sm:w-[80%] md:w-[70%] lg:w-[50%] rounded-xl bg-slate-50 bg-clip-border text-slate-800 transition ease-in-out delay-150 hover:translate-y-1 hover:scale-100 duration-300 p-4'>

    <div class="w-full h-full relative flex flex-col">

        <div class="w-full flex m-auto justify-between">
            <span class="image-dialog-{{ $reservation->id + 5 }} text-lg font-medium cursor-pointer text-teal-800"
                data-dialog-target="image-dialog-{{ $reservation->id + 5 }}">{{ $event->nom }}</span>
            <div class="flex gap-1 items-center">
                <span class="text-base font-medium">{{ $reservation->nombrePlace }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
        </div>

        <div class="w-full flex-col my-1 text-slate-700 px-3">
            <div class="flex gap-1 justify-start items-center mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="red" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>

                <span class="text-md text-slate-700">{{ $event->lieu }}</span>
            </div>
            <div class="flex gap-1 justify-start items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="blue" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <span class="text-md text-slate-700">{{ $event->dateEvenement }}</span>
            </div>
        </div>

        <div class="flex justify-end w-full items-center gap-3">
            <button
                class="flex select-none items-center gap-3  rounded-lg border border-red-500 py-2 px-2 sm:px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" data-ripple-dark="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="red" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>

            <button
                class="flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-2 sm:px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" data-ripple-dark="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="h-4 w-4">
                    <path fill-rule="evenodd"
                        d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <button
                class="flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-2 sm:px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" data-ripple-dark="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                </svg>

            </button>
        </div>

    </div>

</div>







<div data-dialog-backdrop="image-dialog-{{ $reservation->id }}" data-dialog-backdrop-close="true"
    class="overflow-y-auto pointer-events-none fixed inset-0 z-[99] grid h-screen w-screen place-items-center bg-black bg-opacity-20 opacity-0 transition-opacity duration-300">
    <div class="z-[100] relative m-4 min-w-[90%] sm:min-w-[90%] sm:max-w-[90%] md:min-w-[80%] md:max-w-[80%] lg:min-w-[70%] lg:max-w-[70%] max-w-[90%]  rounded-lg bg-white font-sans text-base font-light leading-relaxed antialiased shadow-2xl"
        role="dialog" data-dialog="image-dialog-{{ $reservation->id }}">

        {{ $reservation->id }}

    </div>
</div>







<div data-dialog-backdrop="image-dialog-{{ $reservation->id + 5 }}" data-dialog-backdrop-close="true"
    class="overflow-y-auto pointer-events-none fixed inset-0 z-[99] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
    <div class="z-[100] relative m-4 min-w-[90%] sm:min-w-[90%] sm:max-w-[90%] md:min-w-[80%] md:max-w-[80%] lg:min-w-[70%] lg:max-w-[70%] max-w-[90%]  rounded-lg bg-white font-sans text-base font-light leading-relaxed antialiased shadow-2xl"
        role="dialog" data-dialog="image-dialog-{{ $reservation->id + 5 }}">


        <div
            class="relative border-t border-b border-t-blue-100 border-b-blue-100 p-0  rounded-t-lg font-sans text-base font-light leading-relaxed antialiased">
            <img alt="nature"
                class="h-[10rem] sm:h-[100px] md:h-[200px] lg:h-[250px] w-full object-cover object-center  rounded-t-lg"
                src="https://images.unsplash.com/photo-1485470733090-0aae1788d5af?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2717&amp;q=80" />

            <div class="flex flex-col justify-end bg-black bg-opacity-50 absolute inset-0 h-full w-full px-1 py-1">
                <span class="md:text-4xl sm:text-3xl text-2xl text-white mb-3">{{ $data->nom }}</span>

            </div>
        </div>
        <div class="flex flex-col items-start gap-1 p-4">

            <div class="flex flex-row w-full justify-end gap-3">
                <button
                    class="bg-transparent border-solid hover:bg-purple-950 text-black font-semibold p-1 border border-purple-950 hover:border-transparent rounded">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>


                    Payer le ticket

                </button>

                <button
                    class="flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button" data-ripple-dark="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>

                <button
                    class="flex select-none items-center gap-3  rounded-lg border border-gray-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button" data-ripple-dark="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        aria-hidden="true" class="h-4 w-4">
                        <path fill-rule="evenodd"
                            d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Partager
                </button>
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
