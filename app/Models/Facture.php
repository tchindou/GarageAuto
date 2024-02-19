<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'facture';

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }
}
