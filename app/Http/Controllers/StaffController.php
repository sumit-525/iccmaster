<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class StaffController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $data['title'] = 'Manage Staff';
        $tableName = (new User)->getTable();
        $data['tablename'] = $tableName;
        $data['staffs'] = User::withoutRole('admin')->get();
        if ($id != '') {
            $id = decrypt($id);
            $data['editstaff'] = User::where('id', $id)->first();
        } else {
            $data['editstaff'] = '';
        }
        if ($request->ajax()) {
            $data = User::withoutRole('admin')->orderBy('position_by', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role_name', function ($row) {
                    return $row?->role?->name;
                })
                ->addColumn('status', function ($row) use ($tableName) {
                    if ($row->status == 1) {
                        return "<div class='dropdown d-inline-block user-dropdown'>
                                <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <div class='badge bg-success-subtle text-success font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='PendingSpin{$row->id}'></i>Active</div>
                                    <i class='fa fa-angle-down'></i>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end p-2'>
                                    <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '0', '{$tableName}')\">Inactive</a>
                                </div>
                            </div>";
                    } else {
                        return "<div class='dropdown d-inline-block user-dropdown'>
                                <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    <span class='d-xl-inline-block ms-1'>
                                        <div class='badge bg-danger-subtle text-danger font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='publicationSpin{$row->id}'></i>Inactive</div>
                                    </span>
                                    <i class='fa fa-angle-down'></i>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end'>
                                    <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '1', '{$tableName}')\">Active</a>
                                </div>
                            </div>";
                    }
                })
                ->addColumn('action', function ($row) use ($tableName) {
                    $encryptedId = encrypt($row->id);
                    $actionBtn = '<a href="' . route('admin.editstaff', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                  <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
                    return $actionBtn;
                })
                ->setRowAttr([
                    'data-id' => function ($row) {
                        return $row->id;
                    },
                ])
                ->rawColumns(['role_name', 'status', 'action'])
                ->make(true);
        }
        return view('admin.staff', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Add Staff';
        $tableName = (new User)->getTable();
        $data['tablename'] = $tableName;
        $data['roles']=Role::where('name','!=','admin')->get();

        if ($id != '') {
            $id = decrypt($id);
            $data['editstaff'] = User::where('id', $id)->first();
        } else {
            $data['editstaff'] = '';
        }

        return view('admin.addstaff', $data);
    }

    public function save(Request $request, $id = '')
    {

        $total = User::count();
        $position_by = $total + 1;
        $id = $request->id;

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data including the custom rule for duplicate entry
            $request->validate([
                'name' => 'required|string|max:255',
                'role_id' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id),],
                'mobile' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'password' => 'required',

                'downloadlimit' => 'required',
                'exportlimit' => 'required',
                'subscriptionstartdate' => 'required',
                'subscriptionenddate' => 'required',
            ]);

            $user = User::find($request->id);
            if (!empty($user)) {
                $user->update([

                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'downloadlimit' => $request->downloadlimit,
                    'exportlimit' => $request->exportlimit,
                    'original_password' => $request->password,
                    'password' => bcrypt($request->password),
                     'subscriptionstartdate' => $request->subscriptionstartdate,
                    'subscriptionenddate' => $request->subscriptionenddate,
                ]);
                $user->roles()->detach();
                $user->assignRole($request->role_id);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Designation with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'role_id' => 'required',
                'email' => 'required|string|max:255|unique:users,email',
                'mobile' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'downloadlimit' => 'required',
                'exportlimit' => 'required',
                'password' => 'required',
                'subscriptionstartdate' => 'required',
                'subscriptionenddate' => 'required',
            ]);

            // Create a new designation instance
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->downloadlimit = $request->downloadlimit;
            $user->exportlimit = $request->exportlimit;
            $user->original_password = $request->password;

            $user->password = bcrypt($request->password);
            $user->subscriptionstartdate = $request->subscriptionstartdate;
            $user->subscriptionenddate = $request->subscriptionenddate;
            $user->position_by = $position_by;
            $user->save();
            $user->assignRole($request->role_id);

            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.staff');
    }
}
