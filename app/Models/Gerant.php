<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gerant extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'gerant';

    public function garage()
    {
        return $this->HasMany(Garage::class, 'garage');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'user');
    }
}
