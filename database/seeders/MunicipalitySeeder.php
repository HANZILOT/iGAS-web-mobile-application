<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $municipalities = array(
            ['id' => 1,'name' => 'Baao','created_at' => now()],
            ['id' => 2,'name' => 'Balatan','created_at' => now()],
            ['id' => 3,'name' => 'Bato','created_at' => now()],
            ['id' => 4,'name' => 'Buhi','created_at' => now()],
            ['id' => 5,'name' => 'Bula','created_at' => now()],
            ['id' => 6,'name' => 'Iriga','created_at' => now()],
            ['id' => 7,'name' => 'Nabua','created_at' => now()],
        );

        Municipality::insert($municipalities);

        Municipality::all()->each(fn(
            $municipality) => $service->log_activity(model:$municipality, event:'added', model_name: 'Municipality', model_property_name: $municipality->name)
        );
    }
}