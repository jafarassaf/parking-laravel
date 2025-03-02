<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceParking extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'est_libre'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

