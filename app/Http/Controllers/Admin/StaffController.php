<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\AccountCreated;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\GasolineStation;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Staff\StaffRequest;

class StaffController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(User::with('gasoline_station', 'municipality')->byRole('staff')->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_show = route('admin.staffs.show', $row);
                    $route_edit = route('admin.staffs.edit', $row);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                                <a class='dropdown-item' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.staffs.destroy`,`.staff_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.staff.index', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('admin.staff.create', [
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
            'municipalities' => Municipality::pluck('name', 'id'),
        ]);
    }

    public function store(StaffRequest $request)
    {
        $password = Str::random(10); // the random password;

        $user = User::create($request->validated() + [
            'password' => bcrypt($password),
            'is_activated' => true, 
            'role_id' => Role::STAFF,
            'email_verified_at' => now(),
        ]);

        Mail::to($user->email)->send(new AccountCreated(user: $user, password: $password));        // notify staff that the account has successfully created

        return to_route('admin.staffs.index')->with(['success' => 'Staff Added Successfully']);
    }

    public function show(User $staff)
    {
        return view('admin.staff.show', [
            'staff' => $staff->load('gasoline_station', 'avatar'),
        ]);
    }
    
    public function edit(User $staff)
    {
        return view('admin.staff.edit', [
            'staff' => $staff,
            'gasoline_stations' => GasolineStation::pluck('name', 'id'),
            'municipalities' => Municipality::pluck('name', 'id'),
        ]);
    }

    public function update(StaffRequest $request, User $staff)
    {
        $staff->update($request->validated());

        return to_route('admin.staffs.index')->with(['success' => 'Staff Updated Successfully']);
    }
    
    public function destroy(User $staff)
    {
        $staff->delete();

       return $this->res(['success' => 'Staff Deleted Successfully']);
    }
}