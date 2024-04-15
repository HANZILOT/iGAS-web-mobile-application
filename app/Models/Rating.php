<?php

namespace App\Models;

use App\Traits\BelongsToGasolineStation;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use 
    BelongsToGasolineStation,
    BelongsToUser,
    HasFactory;

    protected $fillable = [
        'gasoline_station_id',
        'user_id',
        'rating',
        'comment'
    ];
}