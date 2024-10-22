<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use App\Models\NewsDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Type\Integer;
use Yajra\DataTables\Facades\DataTables;

class NewsDetailsController extends Controller
{
    public function index(Request $request, $newscategory_id = '', $id = '')
    {
        $data['title'] = 'Manage News Details';
        $tableName = (new NewsDetails)->getTable();
        $data['tablename'] = $tableName;
        $data['newscategories'] = NewsCategory::where('status', 1)->get();
        if ($request->ajax()) {
            if ($newscategory_id != '') {
                $data = NewsDetails::with('newscategory')->where('newscategory_id', $newscategory_id)->orderBy('id', 'desc')->get();
            } else {
                $data = NewsDetails::with('newscategory')->orderBy('id', 'desc')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('newscategory_name', function ($row) {
                    return $row->newscategory->name; // Access the role name
                })
                ->addColumn('image', function ($row) {
                    $thumbnail = '<a href="' . asset('storage/' . $row->image) . '" target="_blank"><img src="' . asset('storage/' . $row->image) . '" width="80"></a>';
                    return $thumbnail;
                })
                ->addColumn('status', function ($row) use ($tableName) {
                    if (auth()->user()->can('news-edit')) {
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
                    }
                })
                ->addColumn('action', function ($row) use ($tableName) {
                    $encryptedId = encrypt($row->id);
                    $actionBtn = '';
                    if (auth()->user()->can('news-edit')) {
                        $actionBtn .= '<a href="' . route('admin.editnewsdetails', ['id' => $encryptedId]) . '" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i></a>';
                    }
                    if (Auth::user()->can('news-delete')) {
                        $actionBtn .= ' <a href="javascript:void(0)" onclick="deleteData(\'id\', ' . $row->id . ', \'' . $tableName . '\')" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></a>';
                    }
                    // if (Auth::user()->can('news-view')) {
                        $actionBtn .= ' <a href="' . route('admin.newsfulldetails', ['id' => $row->id]) . '" class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>';
                    // }
                    return $actionBtn;
                })


                ->setRowAttr([
                    'data-id' => function ($row) {
                        return $row->id;
                    },
                ])
                ->rawColumns(['newscategory_name', 'image', 'status', 'action'])
                ->make(true);
        }
        return view('admin.newsdetails', $data);
    }
    public function add(Request $request, $id = '')
    {
        $data['title'] = 'Manage News Details';
        $tableName = (new NewsDetails)->getTable();
        $data['tablename'] = $tableName;
        $data['newscategories'] = NewsCategory::where('status', 1)->get();

        if ($id != '') {
            $id = decrypt($id);


            $data['editnewsdetails'] = NewsDetails::where('id', $id)->first();
        } else {
            $data['editnewsdetails'] = '';
        }

        return view('admin.addnewsdetails', $data);
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

        $total = NewsDetails::count();
        $position_by = $total + 1;
        $id = $request->id;
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('newsdetails', 'public');

            // Delete the old thumbnail if updating an existing record
            if (!empty($request->id)) {
                $newsdetails = NewsDetails::find($request->id);
                Storage::disk('public')->delete($newsdetails->image);
            }
        }
        $embeddedLink = $this->getEmbeddedUrl($request->link);
        // Check if it's an update operation
        if (!empty($request->id)) {
            // Validate the incoming request data including the custom rule for duplicate entry
            $request->validate([
                'title' => 'required|string|max:255',
                'newscategory_id' => 'required',
            ]);

            $newsdetails = NewsDetails::find($request->id);
            if (!empty($newsdetails)) {
                $newsdetails->update([

                    'title' => $request->title,
                    'link' => $embeddedLink,
                    'newscategory_id' => $request->newscategory_id,
                    'image' => isset($imagepath) ? $imagepath : $newsdetails->image, // Update image only if a new one is uploaded
                    'startdate' => $request->startdate,
                    'enddate' => $request->enddate,
                    'description' => $request->description,
                ]);
                Session::flash('success', 'Data updated successfully!');
            } else {
                Session::flash('error', 'News Details with ID ' . $request->id . ' not found.');
            }
        } else {
            $request->validate([
                'title' => 'required|string|max:255',
                'newscategory_id' => 'required',
                'image' => 'required', // Assuming image uploads
            ]);

            // Create a new designation instance
            $newsdetails = new NewsDetails();
            $newsdetails->title = $request->title;
            $newsdetails->link = $embeddedLink;
            $newsdetails->newscategory_id = $request->newscategory_id;
            $newsdetails->image = $imagepath;
            $newsdetails->startdate = $request->startdate;
            $newsdetails->enddate = $request->enddate;
            $newsdetails->description = $request->description;
            $newsdetails->position_by = $position_by;
            $newsdetails->save();
            Session::flash('success', 'Data added successfully!');
        }

        // Redirect back with success or error message
        return redirect()->route('admin.newsdetails');
    }
    public function newsfulldetails(Request $request, $id)
    {

        $data['title'] = 'Full News Details';
        $data['newsdetails'] = NewsDetails::where('id', $id)->first();
        return view('admin.fullnewsdetails', $data);
    }
}
