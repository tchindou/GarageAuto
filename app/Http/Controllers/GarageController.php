<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;

class GarageController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index(Request $request)
        {
                if ($request->page <= 1) {
                        // For the first page, apply the custom filter
                        $garages = Garage::where('valide', true)
                                ->orderBy('boost', 'desc')
                                ->orderBy('likes', 'desc')
                                ->paginate(12);
                } else {
                        // For the following pages, display the events randomly
                        $garages = Garage::where('valide', true)
                                ->inRandomOrder()
                                ->paginate(12);
                }

                return view('garage.acceuil', compact('garages'));
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
                return view('garage.create_event');
        }

        public function search(Request $request)
        {
                $garages = Garage::where('name', 'like', '%' . $request->input('search') . '%')->orWhere('description', 'like', '%' . $request->input('search') . '%')->orWhere('addresse', 'like', '%' . $request->input('search') . '%')->where('valide', true)->paginate(9);

                // return $evenements
                return view('garage.acceuil', compact('garages'));
        }
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
                //
        }

        public function description(Request $request)
        {
                // Récupérer la valeur du paramètre 'event' depuis la requête
                $eventId = $request->query('desc');

                // Autre logique de contrôleur...

                // Retourner la vue avec la valeur de l'événement
                return view('garage.event_desc', ['eventId' => $eventId]);
        }

        /**
         * Display the specified resource.
         */
        public function show(Garage $evenement)
        {
                //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Garage $evenement)
        {
                //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Garage $evenement)
        {
                //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Garage $evenement)
        {
                //
        }
}
