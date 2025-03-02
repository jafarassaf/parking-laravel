<?php

namespace App\Http\Controllers;

use App\Models\PlaceParking;
use Illuminate\Http\Request;

class PlaceParkingController extends Controller
{
    public function index()
    {
        // Récupérer la liste des places
        $places = PlaceParking::all();

        // Retourner la vue "places.index" avec les places
        return view('places.index', compact('places'));
    }
}

