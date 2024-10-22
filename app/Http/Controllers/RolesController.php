<?php

namespace App\Http\Controllers;

use App\DataTables\RoleTeamsDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::where('name','!=','admin')->select('id', 'name')->get();
        return view('admin.roles.roles', compact('roles'));
    }

    public function create($id = null)
    {
        if (!empty($id)) {
            $create_or_edit = 'Edit';
            $role = Role::find($id);
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();
        } else {
            $create_or_edit = 'Create';
            $role = new Role();
            $rolePermissions = [];
        }
        $permissions = Permission::whereNotIn('id',[21,22,23,24])->select('id', 'name')->oldest('id')->orderBy('name')->get()->toArray();
        $permissions_count = count($permissions);
        $permission = array();
        foreach ($permissions as $key => $val) {
            $name = explode('-', $val['name']);
            $key = implode(' ', array_slice($name, 0, -1));

            $permission[$key][] = $val;
        }
        return view('admin.roles.roles_create', compact('permission', 'role', 'rolePermissions', 'create_or_edit', 'permissions_count'));
    }

    public function store(Request $request, $id = null)
    {
        $request->validate([
            'role' => 'required|string|max:200|unique:roles,name,' . $id,
        ]);

        try {

            if (!empty($id)) {
                $role = Role::find($id);
                $role->name = $request->role;
                $role->save();
                $message = 'Role updated successfully.';
            } else {
                $role = Role::create(['name' => $request->role]);
                $message = 'Role created successfully.';
            }

            $role->syncPermissions($request->permission);
            Session::flash('success', 'Permission Saved successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Something went wrong.');
            return redirect()->back();
        }
    }

    public function add_member(Request $request)
    {
        $role_id = $request->id;
        $users = User::get(['id', 'name']);
        $returnHTML = view('settings.add-member', compact('users', 'role_id'))->render();
        return response()->json(array('success' => 200, 'html' => $returnHTML));
    }

    public function store_member(Request $request)
    {

        $users = $request->users;
        $role = Role::select('name')->find($request->id);

        foreach ($users as $user_id) {
            $user = User::find($user_id);
            $user->assignRole($role['name']);
        }
        return response()->json(['status' => 200, 'message' => 'Member Added Successfully', 'redirect' => route('settings.roles')]);
    }

    function ourTeams()
    {
        // addVendors(['datatable']);
        return view('settings.roles_team');
    }

    // function TeamsDatatable(RoleTeamsDataTable $datatable)
    // {
    //     return $datatable->render();
    // }
}
