<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'intervention';

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function tache()
    {
        return $this->belongsTo(Tache::class);
    }

    public function factures()
    {
        return $this->HasMany(Facture::class);
    }
}
