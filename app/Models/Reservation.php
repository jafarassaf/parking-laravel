<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'place_parking_id', 'debut', 'expiration', 'statut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function placeParking()
    {
        return $this->belongsTo(PlaceParking::class);
    }
}

