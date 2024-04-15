<?php 

namespace App\Traits;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToMunicipality {

    /**
     * this model belongs to Municipality
     *
     * @return BelongsTo
     */
    public function municipality():BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }
}