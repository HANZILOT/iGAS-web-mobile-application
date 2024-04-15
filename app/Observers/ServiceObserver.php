<?php

namespace App\Observers;

use App\Models\Service;
use App\Services\ActivityLogsService;

class ServiceObserver
{
    protected $activity_logs_service;

    public function __construct(ActivityLogsService $activity_logs_service)
    {
        $this->activity_logs_service = $activity_logs_service;
    }
    
    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $this->activity_logs_service->log_activity(model:$service, event:'added', model_name: 'Service', model_property_name: $service->name . ' for '. $service->gasoline_station->name);
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        $this->activity_logs_service->log_activity(model:$service, event:'updated', model_name: 'Service', model_property_name: $service->name . ' for '. $service->gasoline_station->name);
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        $this->activity_logs_service->log_activity(model:$service, event:'deleted', model_name: 'Service', model_property_name: $service->name . ' for '. $service->gasoline_station->name);
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}