<?php

namespace App\Observers;

use App\Models\GasolineStation;
use App\Services\ActivityLogsService;

class GasolineStationObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the GasolineStation "created" event.
     *
     * @param  \App\Models\GasolineStation  $gasolineStation
     * @return void
     */
    public function created(GasolineStation $gasolineStation)
    {
        $this->service->log_activity(model:$gasolineStation, event:'added', model_name:'Gasoline Station', model_property_name: $gasolineStation->name);
    }

    /**
     * Handle the GasolineStation "updated" event.
     *
     * @param  \App\Models\GasolineStation  $gasolineStation
     * @return void
     */
    public function updated(GasolineStation $gasolineStation)
    {
        $this->service->log_activity(model:$gasolineStation, event:'updated', model_name:'Gasoline Station', model_property_name: $gasolineStation->name);
    }

    /**
     * Handle the GasolineStation "deleted" event.
     *
     * @param  \App\Models\GasolineStation  $gasolineStation
     * @return void
     */
    public function deleted(GasolineStation $gasolineStation)
    {
        $this->service->log_activity(model:$gasolineStation, event:'deleted', model_name:'Gasoline Station', model_property_name: $gasolineStation->name);
    }

    /**
     * Handle the GasolineStation "restored" event.
     *
     * @param  \App\Models\GasolineStation  $gasolineStation
     * @return void
     */
    public function restored(GasolineStation $gasolineStation)
    {
        //
    }

    /**
     * Handle the GasolineStation "force deleted" event.
     *
     * @param  \App\Models\GasolineStation  $gasolineStation
     * @return void
     */
    public function forceDeleted(GasolineStation $gasolineStation)
    {
        //
    }
}