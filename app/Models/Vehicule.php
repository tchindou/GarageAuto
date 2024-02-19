<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'vehicule';

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
