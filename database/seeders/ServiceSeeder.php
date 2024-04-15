<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $activity_logs_service)
    {
        $services = array(

        );

        Service::insert($services);

        Service::all()->each(fn(
            $service) => $activity_logs_service->log_activity(model:$service, event:'added', model_name: 'Gasoline Station Service', model_property_name: $service->name . ' for ' . $service->gasoline_station->name)
        );
    }
}