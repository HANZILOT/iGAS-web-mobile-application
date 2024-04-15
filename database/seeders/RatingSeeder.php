<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Services\ActivityLogsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $ratings = array(
            [
                'id' => 1,
                'gasoline_station_id' => 1,
                'user_id' => 3,
                'rating' => 4,
                'comment' => 'good service',
                'created_at' => now()->subDay()
            ],
        );

        Rating::insert($ratings);

        Rating::all()->each(fn(
            $rating) => $service->log_activity(model:$rating, event:'added', model_name: 'Rating', model_property_name: $rating->rating . ' for '. $rating->gasoline_station->name, end_user: $rating->user->full_name)
        );
    }
}