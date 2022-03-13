<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $fillable = ["name", "description", "type", "status", "image", "user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itinerates()
    {
        return $this->hasMany(Itineraty::class);
    }
}
