<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garage;
use App\Models\User;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        // Récupérer la valeur de event_id depuis la requête
        $garageId = $request->input('event_id');

        $garage = Garage::find($garageId);

        $garage->likes++;
        $garage->save();

        // Retourner une réponse à la requête Ajax
        return response()->json(['message' => 'Like effectué avec succès pour garage_id : ' . $garageId]);
    }

    public function unlike(Request $request)
    {
        // Récupérer la valeur de event_id depuis la requête
        $garageId = $request->input('event_id');

        $garage = Garage::find($garageId);

        $garage->likes--;
        $garage->save();

        // Retourner une réponse à la requête Ajax
        return response()->json(['message' => 'Dislike effectué avec succès pour garage_id : ' . $garageId]);
    }
}
