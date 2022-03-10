<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraty extends Model
{
    use HasFactory;
    protected $fillable = ["status", "cost", "ship_id", "bay_id", "date_takeoff", "date_estimated_takeoff", "date_landin", "date_estimated_landing"];
    protected $dates = ["date_takeoff", "date_estimated_takeoff", "date_landin", "date_estimated_landing"];
}
