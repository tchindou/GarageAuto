<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $table = 'piece';

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }
}
