<?php 

namespace App\Traits;

use App\Models\GasolineStation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToGasolineStation {

    /**
     * this model belongs to GasolineStation
     *
     * @return BelongsTo
     */
    public function gasoline_station():BelongsTo
    {
        return $this->belongsTo(GasolineStation::class);
    }
}