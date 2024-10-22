<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request, $id = '')
    {
        $data['title'] = 'Manage Category';
        $tableName = (new Category)->getTable();
        $data['tablename'] = $tableName;

        if ($id != '') {
            $id = decrypt($id);
            $data['editcategory'] = Category::where('id', $id)->first();
        } else {
            $data['editcategory'] = '';
        }
        $data['categories'] = Category::where('status', 1)->orderBy('id','desc')->get();
        return view('admin.category', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Manage Category';
        $tableName = (new Category)->getTable();
        $data['tablename'] = $tableName;

        if ($id != '') {
            $id = decrypt($id);
            $data['editcategory'] = Category::where('id', $id)->first();
        } else {
            $data['editcategory'] = '';
        }


        return view('admin.addcategory', $data);
    }


    public function save(Request $request)
    {
        // dd($request->all());
        $total = Category::count();
        $position_by = $total + 1;
        // Handle file upload
        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required', 'string',  'max:255', Rule::unique('categories')->ignore($request->id),],
            ]);
            $category = Category::find($request->id);
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
                'name' => 'required|string|max:255|unique:categories,name',
            ]);
            // Create a new company instance
            $category = new Category();
            $category->name = $request->name;
            $category->position_by = $position_by;
            $category->save();
            Session::flash('success', 'Data added successfully!');
        }
        // Redirect back with success or error message
        return redirect()->route('admin.category');
    }
    public function checkCategoryName(Request $request)
    {
        $isDuplicate = Category::where('name', $request->name)
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
        if (Document::where('category_id', $where_id)->exists()) {
            return redirect()->back()->with('error', "Please delete all documents assigned to this category before deleting the category.");
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
