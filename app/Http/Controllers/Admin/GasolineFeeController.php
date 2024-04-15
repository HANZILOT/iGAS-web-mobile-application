<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\GasolineFee\GasolineFeeRequest;
use App\Models\GasolineFee;
use App\Models\GasolineStation;

class GasolineFeeController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $gasoline_fees = GasolineFee::query()
            ->when($request->filled('gasoline_station'), fn($query) => $query->where('gasoline_station_id', $request->gasoline_station))
            ->with('gasoline_station')
            ->get();

            return DataTables::of($gasoline_fees)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('admin.gasoline_fees.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.gasoline_fees.destroy`,`.gasoline_fee_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.gasoline_fee.index', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.gasoline_fee.create', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function store(GasolineFeeRequest $request)
    {
        $validatedData = $request->validated();

        // Check if the selected type is "other" and, if so, use the custom type
        $type = $validatedData['type'] === 'other' ? $validatedData['custom_gasoline_type'] : $validatedData['type'];
        $customGasolineType = $type === 'other' ? $validatedData['custom_gasoline_type'] : '';
    
        // Create a new GasolineFee instance with the correct type
        $gasolineFee = GasolineFee::create([
            'gasoline_station_id' => $validatedData['gasoline_station_id'],
            'type' => $type,
            'custom_gasoline_type' => $customGasolineType,
            'price' => $validatedData['price'],
        ]);
        
        if ($gasolineFee) {
        // The record was successfully saved
         return redirect()->route('admin.gasoline_fees.index')->with(['success' => 'Gasoline Price Added Successfully']);
        } else {
        // There was an error saving the record
            return redirect()->route('admin.gasoline_fees.create')->with(['error' => 'Failed to save the Gasoline Price']);
        }
    }

    public function edit(GasolineFee $gasoline_fee)
    {
        return view('admin.gasoline_fee.edit', [
            'gasoline_fee' => $gasoline_fee,
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function update(GasolineFeeRequest $request, GasolineFee $gasoline_fee)
    {
        $validatedData = $request->validated();

        // Check if the selected type is "other" and, if so, use the custom type
        $type = $validatedData['type'] === 'other' ? $validatedData['custom_gasoline_type'] : $validatedData['type'];
     
        // Update the type and other fields
        $gasoline_fee->update([
            'gasoline_station_id' => $validatedData['gasoline_station_id'],
            'type' => $type,
            'price' => $validatedData['price'],
        ]);
     
        return redirect()->route('admin.gasoline_fees.index')->with(['success' => 'Gasoline Price Updated Successfully']);
    }

    public function destroy(GasolineFee $gasoline_fee)
    {
        $gasoline_fee->delete();

       return $this->res(['success' => 'Gasoline Price Deleted Successfully']);
    }
}