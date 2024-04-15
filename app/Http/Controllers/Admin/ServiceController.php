<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;
use App\Models\GasolineStation;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $services = Service::query()
                ->when($request->filled('gasoline_station'), fn ($query) => $query->where('gasoline_station_id', $request->gasoline_station))
                ->with('gasoline_station')
                ->get();

            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {

                    $route_edit = route('admin.services.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.services.destroy`,`.service_dt`)'>Delete</a>
                            </div>
                        </div> ";

                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.service.index', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.service.create', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());

        return redirect()->route('admin.services.index')->with(['success' => 'Service Added Successfully']);
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', [
            'service' => $service,
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('admin.services.index')->with(['success' => 'Service Updated Successfully']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json(['success' => 'Service Deleted Successfully']);
    }
}
