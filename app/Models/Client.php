<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'client';

    public function rdv()
    {
        return $this->hasMany(Rdv::class);
    }

    public function vehicule()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'user');
    }
}
