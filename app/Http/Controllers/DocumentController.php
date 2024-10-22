<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
    public function index(Request $request, $category_id = '', $id = '')
    {

        $data['title'] = 'Manage Document';
        $tableName = (new Document)->getTable();
        $data['tablename'] = $tableName;
        $data['categories'] = Category::where('status',1)->get();


        if ($category_id != '') {
            $category_id = decrypt($category_id);

            $data['documents'] = Document::where('category_id', $category_id)->orderBy('id', 'desc')->get();
        } else {

            $data['documents'] = Document::orderBy('id','desc')->get();
        }

        // if ($request->ajax()) {
        //     $data = Document::with('category')->orderBy('position_by', 'asc')->get();

        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('category_name', function ($row) {
        //             return $row->category->name; // Access the role name
        //         })
        //         ->addColumn('status', function ($row) use ($tableName) {
        //             if ($row->status == 1) {
        //                 return "<div class='dropdown d-inline-block user-dropdown'>
        //                         <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        //                             <div class='badge bg-success-subtle text-success font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='PendingSpin{$row->id}'></i>Active</div>
        //                             <i class='fa fa-angle-down'></i>
        //                         </button>
        //                         <div class='dropdown-menu dropdown-menu-end p-2'>
        //                             <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '0', '{$tableName}')\">Inactive</a>
        //                         </div>
        //                     </div>";
        //             } else {
        //                 return "<div class='dropdown d-inline-block user-dropdown'>
        //                         <button type='button' class='btn text-dark waves-effect' id='page-header-user-dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        //                             <span class='d-xl-inline-block ms-1'>
        //                                 <div class='badge bg-danger-subtle text-danger font-size-12'><i class='fa fa-spin fa-spinner' style='display:none' id='publicationSpin{$row->id}'></i>Inactive</div>
        //                             </span>
        //                             <i class='fa fa-angle-down'></i>
        //                         </button>
        //                         <div class='dropdown-menu dropdown-menu-end'>
        //                             <a class='dropdown-item' style='cursor:pointer;' onclick=\"changeStatus('id', '{$row->id}', 'status', '1', '{$tableName}')\">Active</a>
        //                         </div>
        //                     </div>";
        //             }
        //         })
        //         ->addColumn('action', function ($row) use ($tableName) {
        //             $encryptedId = encrypt($row->id);
        //             $actionBtn = '';

        //             if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
        //                 $actionBtn .= '<a href="' . route('admin.editdocument', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>';
        //                 $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
        //             }

        //             return $actionBtn;
        //         })
        //         ->addColumn('download', function ($row) use ($tableName) {
        //             $encryptedId = encrypt($row->id);
        //             $actionBtn = '';

        //                 $actionBtn .= '<a href="' . route('admin.editdocument', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-danger"><i class="fa fa-eye"></i></a>';
        //                 $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-success"><i class="fa fa-download"></i></a>';


        //             return $actionBtn;
        //         })

        //         ->setRowAttr([
        //             'data-id' => function ($row) {
        //                 return $row->id;
        //             },
        //         ])
        //         ->rawColumns(['category_name', 'status', 'action', 'download'])
        //         ->make(true);
        // }
        return view('admin.document', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Manage Document';
        $tableName = (new Document)->getTable();
        $data['tablename'] = $tableName;
        $data['categories'] = Category::where('status',1)->get();

        if ($id != '') {
            $id = decrypt($id);


            $data['editdocument'] = Document::where('id', $id)->first();
        } else {
            $data['editdocument'] = '';
        }
        return view('admin.adddocument', $data);
    }
    public function save(Request $request, $id = '')
    {
        $total = Document::count();
        $position_by = $total + 1;
        $id = $request->id;

        // Handle file upload
        if ($request->hasFile('document')) {
            // Upload new document
            $documentpath = $request->file('document')->store('document', 'public');

            // Delete the old document if updating an existing record
            if (!empty($request->id)) {
                $document = Document::find($request->id);
                if ($document && $document->document) {
                    Storage::disk('public')->delete($document->document);
                }
            }
        }

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data including the custom rule for duplicate entry
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required',
            ]);

            $document = Document::find($request->id);
            if (!empty($document)) {
                $document->update([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'document' => isset($documentpath) ? $documentpath : $document->document, // Update document only if a new one is uploaded
                    'startdate' => $request->startdate,
                    'enddate' => $request->enddate,
                    'description' => $request->description,
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Document with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required',
                'document' => 'required', // Assuming document uploads
            ]);

            // Create a new document instance
            $document = new Document();
            $document->title = $request->title;
            $document->category_id = $request->category_id;
            $document->document = $documentpath; // Save the uploaded document path
            $document->startdate = $request->startdate;
            $document->enddate = $request->enddate;
            $document->description = $request->description;
            $document->position_by = $position_by;
            $document->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.document');
    }

}
