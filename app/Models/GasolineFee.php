<?php

namespace App\Models;

use App\Traits\BelongsToGasolineStation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasolineFee extends Model
{
    use 
    HasFactory, 
    BelongsToGasolineStation;

    protected $fillable = [
        'gasoline_station_id',
        'type',
        'custom_gasoline_type',
        'price',
    ];
}