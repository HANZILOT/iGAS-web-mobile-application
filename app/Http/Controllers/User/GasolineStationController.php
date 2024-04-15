<?php

namespace App\Http\Controllers\User;

use App\Models\Search;
use Illuminate\Http\Request;
use App\Models\GasolineStation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GasolineStationController extends Controller
{
    public function index(Request $request)
    {
        $search_gasoline_station = $request->gasoline_station_id;

        $gasoline_stations = GasolineStation::with('gasoline_fees')->get();

        $selected_gasoline_station = $search_gasoline_station ? GasolineStation::with('gasoline_fees')->whereId($search_gasoline_station)->first() : null;

        $selected_gasoline_station ? auth()->user()->searches()->firstOrCreate(['gasoline_station_id' => $selected_gasoline_station->id]) : '';   // saved search gasoline_station

        $searches = Search::with('gasoline_station')->whereBelongsTo(auth()->user())->get();

        return view('user.gasoline_station.index', compact(
            'gasoline_stations', 
            'selected_gasoline_station', 
            'searches'
        ));

    }

    public function show(GasolineStation $gasoline_station)
    {
        return view('user.gasoline_station.show', [
            'gasoline_station' => $gasoline_station->load('municipality', 'gasoline_fees', 'services', 'users', 'ratings'),
        ]);
    }

}