<?php

namespace App\Models;

use App\Traits\BelongsToGasolineStation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use 
    HasFactory,
    BelongsToGasolineStation
    ;

    protected $fillable = [
        'gasoline_station_id',
        'service'
    ];
}