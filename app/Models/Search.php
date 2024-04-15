<?php

namespace App\Models;

use App\Traits\BelongsToGasolineStation;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory, 
    BelongsToUser, 
    BelongsToGasolineStation;

    protected $fillable = [
        'user_id',
        'gasoline_station_id'
    ];
}