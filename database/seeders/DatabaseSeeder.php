<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run Seeders
       
        $this->call([

            MunicipalitySeeder::class,

              /** Start Gas Station Management */
                  GasolineStationSeeder::class,
                  ServiceSeeder::class,
                  GasolineFeeSeeder::class,
              /** End Gas Station Management */
            
                RoleSeeder::class,
                UserSeeder::class,
                RatingSeeder::class,
      
        ]);

    }
}