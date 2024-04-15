<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Campus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GasolineStation;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke()
    {
        $gasoline_stations = GasolineStation::query();

        return view('admin.dashboard.index', [
            'activities' => Activity::latest()->take(5)->get(),
            'total_active_user' => User::notAdmin()->active()->count(),
            'total_inactive_user' => User::notAdmin()->inactive()->count(),
            'total_gasoline_station' => GasolineStation::count(),
            'total_staff' => User::byRole('staff')->count(),
            'users' => User::notAdmin()->latest()->paginate(5),
            'recent_gasoline_stations' => $gasoline_stations->paginate(5),
            'gasoline_stations' => $gasoline_stations->get(),

            // charts
            'chart_total_services_by_gasoline_station' => $this->get_total_services_by_gasoline_station(),
            'chart_total_gasoline_type_by_gasoline_station' => $this->get_total_gasoline_type_by_gasoline_station(),
            'chart_monthly_user' => $this->get_monthly_user(),

            // map
            'map_gasoline_stations' => GasolineStation::all(),
        ]);
    }

    private function get_total_services_by_gasoline_station()
    {
        $gasoline_stations = [];
        $total_services = [];

        foreach (GasolineStation::withCount('services')->get() as $gasoline_station) {
            $gasoline_stations[] = $gasoline_station->name;
            $total_services[] = $gasoline_station->services_count;
        }

        return [$gasoline_stations, $total_services];
    }


    private function get_total_gasoline_type_by_gasoline_station()
    {
        $gasoline_stations = [];
        $total_gasoline_type = [];

        foreach (GasolineStation::withCount('gasoline_fees')->get() as $gasoline_station) {
            $gasoline_stations[] = $gasoline_station->name;
            $total_gasoline_type[] = $gasoline_station->gasoline_fees_count;
        }

        return [$gasoline_stations, $total_gasoline_type];
    }


    /**
     * get montly user
     *
     * @return void
     */
    private function get_monthly_user()
    {
        $monthly_users = User::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->notAdmin()
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_users = array();

        $months = $monthly_users->pluck('month')->all();
        $total_monthly_users = $monthly_users->pluck('total_users')->all();

        return [$months, $total_monthly_users];
    }

}