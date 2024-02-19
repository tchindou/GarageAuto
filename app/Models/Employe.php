<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'employe';

    public function tache()
    {
        return $this->hasMany(Tache::class);
    }

    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }

    public function rdv()
    {
        return $this->hasMany(Rdv::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'user');
    }
}
