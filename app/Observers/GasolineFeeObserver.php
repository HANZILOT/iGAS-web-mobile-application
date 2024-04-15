<?php

namespace App\Observers;

use App\Models\GasolineFee;
use App\Services\ActivityLogsService;

class GasolineFeeObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the GasolineFee "created" event.
     *
     * @param  \App\Models\GasolineFee  $gasolineFee
     * @return void
     */
    public function created(GasolineFee $gasolineFee)
    {
        $this->service->log_activity(model:$gasolineFee, event:'added', model_name: 'Gasoline Fee', model_property_name: $gasolineFee->name . ' for '. $gasolineFee->gasoline_station->name);
    }

    /**
     * Handle the GasolineFee "updated" event.
     *
     * @param  \App\Models\GasolineFee  $gasolineFee
     * @return void
     */
    public function updated(GasolineFee $gasolineFee)
    {
        $this->service->log_activity(model:$gasolineFee, event:'updated', model_name: 'Gasoline Fee', model_property_name: $gasolineFee->name . ' for '. $gasolineFee->gasoline_station->name);
    }

    /**
     * Handle the GasolineFee "deleted" event.
     *
     * @param  \App\Models\GasolineFee  $gasolineFee
     * @return void
     */
    public function deleted(GasolineFee $gasolineFee)
    {
        $this->service->log_activity(model:$gasolineFee, event:'deleted', model_name: 'Gasoline Fee', model_property_name: $gasolineFee->name . ' for '. $gasolineFee->gasoline_station->name);
    }

    /**
     * Handle the GasolineFee "restored" event.
     *
     * @param  \App\Models\GasolineFee  $gasolineFee
     * @return void
     */
    public function restored(GasolineFee $gasolineFee)
    {
        //
    }

    /**
     * Handle the GasolineFee "force deleted" event.
     *
     * @param  \App\Models\GasolineFee  $gasolineFee
     * @return void
     */
    public function forceDeleted(GasolineFee $gasolineFee)
    {
        //
    }
}