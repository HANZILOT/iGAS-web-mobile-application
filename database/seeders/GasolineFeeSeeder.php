<?php

namespace Database\Seeders;

use App\Models\GasolineFee;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GasolineFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {

        $gasoline_fees = array(

           
        );

        GasolineFee::insert($gasoline_fees);

        GasolineFee::all()->each(fn(
            $gasoline_fee) => $service->log_activity(model:$gasoline_fee, event:'added', model_name: 'Gasoline Fee', model_property_name: $gasoline_fee->name . ' for '. $gasoline_fee->gasoline_station->name)
        );
    }
}