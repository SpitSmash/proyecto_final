<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    public function itineraty()
    {
        return $this->belongsTo(Itineraty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
