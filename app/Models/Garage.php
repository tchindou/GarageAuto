<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'garage';

    public function client()
    {
        return $this->hasMany(Client::class);
    }

    public function employe()
    {
        return $this->hasMany(Employe::class);
    }

    public function user()
    {
    }

    public function vehicule()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function rdv()
    {
        return $this->hasMany(Rdv::class);
    }

    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }

    public function piece()
    {
        return $this->hasMany(Piece::class);
    }

    public function gerant()
    {
        return $this->belongsTo(Gerant::class);
    }
}
