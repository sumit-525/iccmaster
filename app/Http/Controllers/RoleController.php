<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display the role page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id = '')
    {
        $tableName = (new Roles)->getTable();
        $data['tablename'] = $tableName;

        if ($id != '') {
            $id = decrypt($id);
            $data['editrole'] = Roles::where('id', $id)->first();
        } else {
            $data['editrole'] = '';
        }

        $data['title'] = 'Roles';
        $data['designations'] = Roles::where('status', 1)->get();
        if ($request->ajax()) {
            $data = Roles::orderBy('position_by', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
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
                                <div class='dropdown-menu dropdown-menu-end p-2'>
                                    <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '1', '{$tableName}')\">Active</a>
                                </div>
                            </div>";
                    }
                })
                ->addColumn('action', function ($row) use ($tableName) {
                    $encryptedId = encrypt($row->id);
                    $actionBtn = '<a href="' . route('admin.editrole', ['id' => $encryptedId]) . '"class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
                    return $actionBtn;
                })
                ->setRowAttr([
                    'data-id' => function ($row) {
                        return $row->id;
                    },
                ])
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.role', $data);
    }


    public function save(Request $request)
    {
        // dd($request->all());
        $total = Roles::count();
        $position_by = $total + 1;
        // Handle file upload
        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'role_name' =>['required','string',  'max:255', Rule::unique('roles')->ignore($request->id),],
            ]);
            $role = Roles::find($request->id);
            if (!empty($role)) {
                $role->update([
                    'role_name' => $request->role_name,
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Company with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
             'role_name' => 'required|string|max:255|unique:roles,role_name',
            ]);
            // Create a new company instance
            $role = new Roles();
            $role->role_name = $request->role_name;
            $role->position_by = $position_by;
            $role->save();
            Session::flash('success', 'Data added successfully!');
        }
        // Redirect back with success or error message
        return redirect()->route('admin.role');
    }
    public function checkRoleName(Request $request)
{
    $isDuplicate = Roles::where('role_name', $request->role_name)
                        ->when($request->id, function ($query) use ($request) {
                            return $query->where('id', '!=', $request->id);
                        })
                        ->exists();

    return response()->json(['isDuplicate' => $isDuplicate]);
}
public function destroy(Request $request)
{
    // Retrieve the necessary request parameters
    $where_column = $request->column;
    $where_id = $request->Id;
    $where_table = $request->table;

    // Check if any users are assigned to the specified role
    if (User::where('role_id', $where_id)->exists()) {
        return redirect()->back()->with('error', "Please delete all users assigned to this role before deleting the role.");
    } else {
        // Delete the specified record
        $deleted = DB::table($where_table)
            ->where($where_column, $where_id)
            ->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'The record has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'The record could not be deleted.');
        }
    }
}


}
