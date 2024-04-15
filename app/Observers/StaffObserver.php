<?php

namespace App\Observers;

use App\Models\User;
use App\Services\ActivityLogsService;

class StaffObserver
{
    protected $service;

    public function __construct(ActivityLogsService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if($user->hasRole('staff'))
        {
            $this->service->log_activity(model:$user, event:'added', model_name: 'Staff', model_property_name: $user->full_name . ' for '. $user->gasoline_station->name);
        }
        else
        {
            $this->service->log_activity(model:$user, event:'added', model_name: 'User Account', model_property_name: $user->full_name);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->service->log_activity(model:$user, event:'updated', model_name: 'Staff', model_property_name: $user->full_name);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->service->log_activity(model:$user, event:'deleted', model_name: 'Staff', model_property_name: $user->full_name);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}