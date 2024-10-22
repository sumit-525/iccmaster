<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tender;
use App\Models\TenderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TenderController extends Controller
{
    public function index(Request $request, $tendercategory_id = '', $id = '')
    {
        $data['title'] = 'Manage Tender Details';
        $tableName = (new Tender)->getTable();
        $data['tablename'] = $tableName;
        $data['tendercategories'] = TenderCategory::where('status', 1)->get();
        if (!empty($tendercategory_id)) {
            $data['alltenders'] = Tender::where('tendercategory_id', $tendercategory_id)
            ->with('tendercategory')->orderBy('id', 'desc')
            ->get();
        }
        else
        {
            $data['alltenders'] = Tender::with('tendercategory')->with('tendercategory')
                    ->orderBy('id', 'desc')
                    ->get();
        }
        // if ($request->ajax()) {
        //     if (!empty($tendercategory_id) && $tendercategory_id != "") {
        //             $data = Tender::where('tendercategory_id', $tendercategory_id)
        //             ->orderBy('id', 'desc')
        //             ->get();

        //           if ($data->isEmpty()) {
        //             Log::info('No Tenders found for Category ID:', [$tendercategory_id]);
        //         }
        //     } else {
        //        $data = Tender::with('tendercategory')
        //             ->orderBy('id', 'desc')
        //             ->get();
        //     }
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('tendercategory_name', function ($row) {
        //             return $row->tendercategory->name; // Access the role name
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
        //             if (auth()->user()->can('news-edit')) {
        //                 $actionBtn .= '<a href="' . route('admin.edittenderdetails', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>';
        //             }
        //             if (Auth::user()->can('news-delete')) {
        //                 $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
        //             }

        //             return $actionBtn;
        //         })


        //         ->setRowAttr([
        //             'data-id' => function ($row) {
        //                 return $row->id;
        //             },
        //         ])
        //         ->rawColumns(['tendercategory_name', 'status', 'action'])
        //         ->make(true);
        // }
        return view('admin.tender', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Manage Tender Details';
        $tableName = (new Tender)->getTable();
        $data['tablename'] = $tableName;
        $data['tendercategories'] = tendercategory::where('status', 1)->get();

        if ($id != '') {
            $id = decrypt($id);


            $data['edittenderdetails'] = Tender::where('id', $id)->first();
        } else {
            $data['edittenderdetails'] = '';
        }

        return view('admin.addtender', $data);
    }
    private function getEmbeddedUrl($url)
    {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches) || preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
            return 'https://www.youtube.com/embed/' . $youtube_id;
        }

        // Return the original URL if no match is found
        return $url;
    }

    public function save(Request $request, $id = '')
    {
        $total = Tender::count();
        $position_by = $total + 1;
        $id = $request->id;

        // Initialize $imagepath as empty
        $imagepath = '';

        // Handle file upload
        if ($request->hasFile('document')) {
            $imagepath = $request->file('document')->store('tender', 'public');

            // Delete the old document if updating an existing record and a new file is uploaded
            if (!empty($request->id)) {
                $tenderdetails = Tender::find($request->id);
                if ($tenderdetails && $tenderdetails->document) {
                    Storage::disk('public')->delete($tenderdetails->document);
                }
            }
        }

        // Prepare the embedded link from the provided URL
        $embeddedLink = $this->getEmbeddedUrl($request->link);

        // Validation rules
        $validationRules = [
            'title' => 'required|string|max:255',
            'tendercategory_id' => 'required',
            'country' => 'required|string|max:255',
            'state' => 'required',
            'city' => 'required',
        ];

        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the request data
            $request->validate($validationRules);

            $tenderdetails = Tender::find($request->id);

            if ($tenderdetails) {
                // Update the record, keep the old document if no new file is uploaded
                $tenderdetails->update([
                    'title' => $request->title,
                    'link' => $embeddedLink,
                    'tendercategory_id' => $request->tendercategory_id,
                    'document' => !empty($imagepath) ? $imagepath : $tenderdetails->document, // Keep old file if no new file
                    'startdate' => $request->startdate,
                    'enddate' => $request->enddate,
                    'description' => $request->description,
                ]);

                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'Tender Details with ID ' . $request->id . ' not found.');
            }
        } else {
            // Validate the request data for the creation process
            $request->validate($validationRules);

            // Create a new tender instance
            $tenderdetails = new Tender();
            $tenderdetails->title = $request->title;
            $tenderdetails->link = $embeddedLink;
            $tenderdetails->tendercategory_id = $request->tendercategory_id;
            $tenderdetails->document = $imagepath; // Save the file path (empty if no file uploaded)
            $tenderdetails->startdate = $request->startdate;
            $tenderdetails->enddate = $request->enddate;
            $tenderdetails->country = $request->country;
            $tenderdetails->state = $request->state;
            $tenderdetails->city = $request->city;
            $tenderdetails->description = $request->description;
            $tenderdetails->position_by = $position_by;
            $tenderdetails->save();

            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.tender');
    }

}
