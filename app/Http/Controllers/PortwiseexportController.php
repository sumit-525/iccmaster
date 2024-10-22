<?php

namespace App\Http\Controllers;

use App\DataTables\PortWiseDataTable;
use App\Exports\CheckedRowsExport;
use App\Http\Controllers\Controller;
use App\Models\PortWise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PortwiseexportController extends Controller
{
    public function index(PortWiseDataTable $datatable)
    {
        return $datatable->render('admin.portwiseexport');
    }
    public function add()
    {
        return view('admin.addportwiseexport');
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xls,xlsx,csv',
        ]);

        $file = $request->file('excel');
        $fileType = $file->getClientOriginalExtension();

        $spreadsheet = null;

        if ($fileType == 'csv') {
            $reader = new Csv();
        } elseif ($fileType == 'xlsx') {
            $reader = new Xlsx();
        } elseif ($fileType == 'xls') {
            $reader = new Xls();
        } else {
            return back()->withErrors('Invalid file type. Only CSV, XLSX, and XLS files are allowed.');
        }

        $spreadsheet = $reader->load($file->getPathName());
        $data = $spreadsheet->getActiveSheet()->toArray();
        $header = $data[0];

        foreach ($data as $row) {
            $rowData = array_combine($header, $row);
            PortWise::Create($rowData);
        }
        Session::flash('success', 'File uploaded and data processed successfully.');
        return redirect()->route('admin.portwiseexportdata')->with('success', 'File uploaded and data processed successfully.');
    }

    public function exportChecked(Request $request)
    {
        $user = Auth::user();
        $ids = $request->query('ids');
        $count = count($ids);

        if ($user->hasRole('admin') || $user->exportlimit >= $count) {
            $user->decrement('exportlimit', $count);
            return response()->json([
                'status' => 1,
                'url' => route('admin.portwise.export.download') . '?ids=' . implode(',', $ids)
            ]);
        } else {
            $export_rem=(!empty($user->exportlimit)) ? "You can only export up to {$user->exportlimit} items." : "";
            return response()->json([
                'status' => 0,
                'message' => "You have exceeded your export limit. {$export_rem}"
            ], 403);
        }
    }

    public function export(Request $request)
    {
        $ids = explode(',', $request->ids);
        return Excel::download(new CheckedRowsExport($ids), 'portwise.xlsx');
    }
}
