<?php

namespace App\Http\Controllers;

use App\Models\PlaceParking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Méthode pour réserver une place
    public function reserver(Request $request)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur a déjà une réservation active ou est en file d'attente
        if ($user->reservations()->where('statut', 'active')->exists()) {
            return redirect()->back()->with('error', 'Vous avez déjà une réservation active.');
        }

        // Essayer de trouver une place libre
        $place = PlaceParking::where('est_libre', true)->first();

        if ($place) {
            // Marquer la place comme occupée
            $place->update(['est_libre' => false]);

            // Créer la réservation
            $reservation = Reservation::create([
                'user_id' => $user->id,
                'place_parking_id' => $place->id,
                'debut' => Carbon::now(),
                // Définir la durée par défaut (exemple : +2 heures)
                'expiration' => Carbon::now()->addHours(2),
                'statut' => 'active',
            ]);

            return redirect()->back()->with('success', 'Place réservée avec succès !');
        } else {
            // Si aucune place n'est libre, ajouter l'utilisateur à la file d'attente
            // (Ici, tu peux créer une logique de file d'attente, par exemple en créant une réservation avec place_parking_id null et un statut "attente")
            Reservation::create([
                'user_id' => $user->id,
                'place_parking_id' => null,
                'debut' => Carbon::now(),
                'expiration' => null,
                'statut' => 'attente', // tu peux utiliser ce statut pour la file d'attente
            ]);

            return redirect()->back()->with('info', 'Aucune place disponible. Vous êtes ajouté(e) à la file d\'attente.');
        }
    }

    // Méthode pour annuler une réservation
    public function annuler($id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = Auth::user();

        // S'assurer que l'utilisateur est bien propriétaire de la réservation ou est admin
        if ($user->id !== $reservation->user_id && $user->role !== 'admin') {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }

        // Libérer la place si elle était occupée
        if ($reservation->place_parking_id) {
            $place = PlaceParking::find($reservation->place_parking_id);
            if ($place) {
                $place->update(['est_libre' => true]);
            }
        }

        $reservation->update(['statut' => 'annulée']);

        return redirect()->back()->with('success', 'Réservation annulée.');
    }

    // Tu peux ajouter d'autres méthodes, comme pour terminer une réservation ou gérer l'expiration automatique.
}

