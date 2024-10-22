<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tender;
use App\Models\TenderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TenderCategoryController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $data['title'] = 'Manage Category';
        $tableName = (new TenderCategory)->getTable();
        $data['tablename'] = $tableName;
        if ($id != '') {
            $id = decrypt($id);
            $data['edittendercategory'] = TenderCategory::where('id', $id)->first();
        } else {
            $data['edittendercategory'] = '';
        }

         $data['tendercategories'] = TenderCategory::where('status', 1)->orderBy('id','desc')->get();
         if ($request->ajax()) {
            $data = TenderCategory::orderBy('id', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) use ($tableName) {
                     if (auth()->user()->can('tendercategory-edit')) {
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
                     } else {
                        if ($row->status == 1) {
                        return "<div class='dropdown d-inline-block user-dropdown'>
                                    <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='badge bg-success-subtle text-success font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='PendingSpin{$row->id}'></i>Active</div>
                                    </button>
                                </div>";
                     }
                     else{
                        return "<div class='dropdown d-inline-block user-dropdown'>
                            <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <span class='d-xl-inline-block ms-1'>
                                    <div class='badge bg-danger-subtle text-danger font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='publicationSpin{$row->id}'></i>Inactive</div>
                                </span>
                            </button>
                        </div>";

                     }
                    }

                })
                ->addColumn('action', function ($row) use ($tableName) {
                    $encryptedId = encrypt($row->id);
                    $actionBtn = '';

                    // Check if the user has permission to edit (tendercategory-edit)
                    if (auth()->user()->can('tendercategory-edit')) {
                        $actionBtn .= ' <a href="' . route('admin.edittendercategory', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-edit"></i></a>';
                    }

                    // Check if the user has permission to delete (tendercategory-delete)
                    if (auth()->user()->can('tendercategory-delete')) {
                        $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash-o"></i></a>';
                    }

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

        return view('admin.tendercategory', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Manage Tender Category';
        $tableName = (new TenderCategory)->getTable();
        $data['tablename'] = $tableName;

        if ($id != '') {
            $id = decrypt($id);
            $data['edittendercategory'] = TenderCategory::where('id', $id)->first();
        } else {
            $data['edittendercategory'] = '';
        }


        return view('admin.addtendercategory', $data);
    }


    public function save(Request $request)
    {
        // dd($request->all());
        $total = TenderCategory::count();
        $position_by = $total + 1;
        // Handle file upload
        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required', 'string',  'max:255', Rule::unique('tendercategories')->ignore($request->id),],
            ]);
            $category = TenderCategory::find($request->id);
            if (!empty($category)) {
                $category->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Category with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'name' => 'required|string|max:255|unique:tendercategories,name',
            ]);
            // Create a new company instance
            $category = new TenderCategory();
            $category->name = $request->name;
            $category->position_by = $position_by;
            $category->save();
            Session::flash('success', 'Data added successfully!');
        }
        // Redirect back with success or error message
        return redirect()->route('admin.tendercategory');
    }
    public function checkTenderCategoryName(Request $request)
    {
        $isDuplicate = TenderCategory::where('name', $request->name)
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
        if (Tender::where('tendercategory_id', $where_id)->exists()) {
            return redirect()->back()->with('error', "Please delete all tender assigned to this category before deleting the category.");
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
