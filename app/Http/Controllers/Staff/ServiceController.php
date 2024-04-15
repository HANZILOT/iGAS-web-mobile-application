<?php

namespace App\Http\Controllers\Staff;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $services = Service::query()
            ->with('gasoline_station')
            ->whereRelation('gasoline_station', 'id', auth()->user()->gasoline_station_id)
            ->get();

            return DataTables::of($services)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('staff.services.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`staff.services.destroy`,`.service_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('staff.service.index');
    }

    public function create()
    {
        return view('staff.service.create');
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());

        return to_route('staff.services.index')->with(['success' => 'Service Added Successfully']);
    }

    public function edit(Service $service)
    {
        return view('staff.service.edit', [
            'service' => $service,
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
       $service->update($request->validated());

       return to_route('staff.services.index')->with(['success' => 'Service Updated Successfully']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

       return $this->res(['success' => 'Service Deleted Successfully']);
    }
}