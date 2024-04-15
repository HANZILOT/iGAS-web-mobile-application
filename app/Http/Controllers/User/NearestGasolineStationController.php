<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\GasolineStation;
use App\Http\Controllers\Controller;

class NearestGasolineStationController extends Controller
{
    /**
     * get the location coordinates based on the authenticated user live location
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        $nearest_gasoline_stations = $this->get_nearest_gasoline_stations(current_location: $request);

        $sorted_nearest_gasoline_stations = $nearest_gasoline_stations->sortBy('distance'); // Sort the nearest gasoline stations based on distance

        return $this->res($sorted_nearest_gasoline_stations);
    }

    private function get_nearest_gasoline_stations($current_location)
    {
        // $currentLocation = [
        //     'latitude' => 13.463530,
        //     'longitude' => 123.363930,
        // ];
        

        $gasoline_stations = GasolineStation::all();  // Retrieve all gasoline stations from the database

        // Calculate the distance to each gasoline station and add it as a new attribute to each station
        $gasoline_stations->transform(function ($gasoline_station) use ($current_location) {

            return [
                'id' => $gasoline_station->id,
                'name' => $gasoline_station->name,
                'distance' => $this->calculate_distance($current_location['latitude'], $current_location['longitude'], $gasoline_station->latitude, $gasoline_station->longitude)
            ];

            // $gasoline_station->distance = $this->calculate_distance($current_location['latitude'], $current_location['longitude'], $gasoline_station->latitude, $gasoline_station->longitude);
            // return $gasoline_station;
        });

        $gasoline_stations = $gasoline_stations->sortBy('distance'); // Sort the gasoline stations based on their distance in ascending order

        $nearest_gasoline_stations = $gasoline_stations->take(3);  // Retrieve the top three nearest gasoline stations

        return $nearest_gasoline_stations;
    }

    // Helper function to calculate the distance between two sets of coordinates using the Haversine formula
    private function calculate_distance($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 6371; // Radius of the earth in kilometers

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earth_radius * $c;

        return $distance;
    }

}