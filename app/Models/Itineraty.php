<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraty extends Model
{
    use HasFactory;
    protected $fillable = ["status", "price", "ship_id", "bay_id", "date_takeoff", "date_estimated_takeoff", "date_landing", "date_estimated_landing"];
    protected $dates = ["date_takeoff", "date_estimated_takeoff", "date_landing", "date_estimated_landing"];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function bays()
    {
        return $this->hasMany(Bay::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }
}
