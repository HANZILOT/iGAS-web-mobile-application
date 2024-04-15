<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GasolineStationController extends Controller
{
    public function __invoke()
    {
        return view('staff.gasoline_station.index', [
            'gasoline_station' => auth()->user()->gasoline_station->load('municipality', 'gasoline_fees', 'services', 'users', 'ratings'),
        ]);
    }
}