<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tache extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'tache';

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function intervention()
    {
        return $this->hasOne(Intervention::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
}
