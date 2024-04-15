<?php

namespace App\Http\Controllers\Staff;

use App\Models\GasolineFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GasolineFee\GasolineFeeRequest;
use Yajra\DataTables\Facades\DataTables;

class GasolineFeeController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $gasoline_fees = GasolineFee::query()
            ->with('gasoline_station')
            ->whereRelation('gasoline_station', 'id', auth()->user()->gasoline_station_id)
            ->get();

            return DataTables::of($gasoline_fees)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('staff.gasoline_fees.edit', $row->id);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`staff.gasoline_fees.destroy`,`.gasoline_fee_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('staff.gasoline_fee.index');
    }

    public function create()
    {
        return view('staff.gasoline_fee.create');
    }

    public function store(GasolineFeeRequest $request)
    {
        $validatedData = $request->validated();

        // Check if the selected type is "other" and, if so, use the custom type
        $type = $validatedData['type'] === 'other' ? $validatedData['custom_gasoline_type'] : $validatedData['type'];
        $customGasolineType = $type === 'other' ? $validatedData['custom_gasoline_type'] : '';

        // Create a new GasolineFee instance with the correct type
        $gasolineFee = GasolineFee::create([
            'gasoline_station_id' => auth()->user()->gasoline_station_id,
            'type' => $type,
            'custom_gasoline_type' => $customGasolineType,
            'price' => $validatedData['price'],
        ]);
        
        if ($gasolineFee) {
        // The record was successfully saved
         return redirect()->route('staff.gasoline_fees.index')->with(['success' => 'Gasoline Price Added Successfully']);
        } else {
        // There was an error saving the record
            return redirect()->route('staff.gasoline_fees.create')->with(['error' => 'Failed to save the Gasoline Price']);
        }
    }

    public function edit(GasolineFee $gasoline_fee)
    {
        return view('staff.gasoline_fee.edit', [
            'gasoline_fee' => $gasoline_fee,
        ]);
    }

    public function update(GasolineFeeRequest $request, GasolineFee $gasoline_fee)
    {
        $validatedData = $request->validated();

        // Check if the selected type is "other" and, if so, use the custom type
        $type = $validatedData['type'] === 'other' ? $validatedData['custom_gasoline_type'] : $validatedData['type'];
     
        // Update the type and other fields
        $gasoline_fee->update([
            'type' => $type,
            'price' => $validatedData['price'],
        ]);
     
        return redirect()->route('staff.gasoline_fees.index')->with(['success' => 'Gasoline Price Updated Successfully']);
    }

    public function destroy(GasolineFee $gasoline_fee)
    {
        $gasoline_fee->delete();

       return $this->res(['success' => 'Gasoline Price Deleted Successfully']);
    }
}