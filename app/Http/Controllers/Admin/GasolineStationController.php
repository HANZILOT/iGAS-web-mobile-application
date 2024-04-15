<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GasolineStation;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\GasolineStation\GasolineStationRequest;
use App\Http\Resources\GasolineStation\GasolineStationResource;
use App\Models\Municipality;

class GasolineStationController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $gas_stations = GasolineStationResource::collection(GasolineStation::query()
                ->when($request->filled('municipality'), fn($query) => $query->where('municipality_id', $request->municipality))
                ->with('media')
                ->get()
            );

            return DataTables::of($gas_stations)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show = route('admin.gasoline_stations.show', $new_row['id']);
                    $route_edit = route('admin.gasoline_stations.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.gasoline_stations.destroy`,`.gasoline_station_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.gasoline_station.index', [
            'municipalities' => Municipality::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.gasoline_station.create', [
            'municipalities' => Municipality::pluck('name', 'id'),
        ]);
    }

    public function store(GasolineStationRequest $request, ImageUploadService $image_upload_service)
    {
        $gasoline_station = GasolineStation::create($request->validated());

        if($request->image) 
        {
            $image_upload_service->handleImageUpload(model:$gasoline_station, images: $request->image, collection:'featured_photo', conversion_name:'card', action:'create');
        }

        return to_route('admin.gasoline_stations.index')->with(['success' => 'Gasoline Station Added Successfully']);
    }

    public function show(GasolineStation $gasoline_station)
    {
        return view('admin.gasoline_station.show', [
            'gasoline_station' => $gasoline_station->load('municipality', 'gasoline_fees', 'services', 'users', 'ratings'),
        ]);
    }

    public function edit(GasolineStation $gasoline_station)
    {
        return view('admin.gasoline_station.edit', [
            'gasoline_station' => $gasoline_station,
            'municipalities' => Municipality::pluck('name', 'id'),
        ]);
    }

    public function update(GasolineStationRequest $request, ImageUploadService $image_upload_service, GasolineStation $gasoline_station)
    {
       $gasoline_station->update($request->validated());

       if($request->image) 
       {
           $image_upload_service->handleImageUpload(model:$gasoline_station, images: $request->image, collection:'featured_photo', conversion_name:'card', action:'update');
       }

       return to_route('admin.gasoline_stations.index')->with(['success' => 'Gasoline Station Updated Successfully']);
    }

    public function destroy(GasolineStation $gasoline_station)
    {
        $gasoline_station->delete();

       return $this->res(['success' => 'Gasoline Station Deleted Successfully']);
    }
}