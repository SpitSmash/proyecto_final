<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    use HasFactory;
    protected $fillable = ["available", "size"];

    public function itineraty()
    {
        return $this->belongsTo(Itineraty::class);
    } 
}
