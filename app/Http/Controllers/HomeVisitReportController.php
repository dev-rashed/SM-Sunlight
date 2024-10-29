<?php
namespace App\Http\Controllers;

use App\Models\HomeVisitReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
 

class HomeVisitReportController extends Controller
{
    public function create()
    {
        return view('home_visit_report.create');
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'serial_number' => 'required',
            'customer_name' => 'required',
            'occupation' => 'required',
            'mobile_number' => 'required|unique:home_visit_reports,mobile_number',
            'village_name' => 'required',
            'word_number' => 'required',
            'union_name' => 'required',
            'thana' => 'required',
            'district' => 'required',
            'home_appliance_have' => 'required',
            'home_appliance_not_have' => 'required',
            'remarks' => 'required',
            'created_at',
            'updated_at',
            
        ]);

        // Store the data in the database
        HomeVisitReport::create($request->all());

        // Redirect after saving
        return redirect()->route('homevisitreport.index')->with('success', 'Data saved successfully.');
    }

    // public function index( Request $request )
    // {
    //     // Get all data from the database
    //     // $homeVisitReports = HomeVisitReport::all();
    //     $search = $request['search'] ?? "";
    //     if($search != "") {
    //         $homeVisitReports = HomeVisitReport::where('customer_name', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->get();
    //     } else {
    //         $homeVisitReports = HomeVisitReport::orderBy('created_at', 'desc')->paginate(5);
    //     }
    //     $homeVisitReports = HomeVisitReport::orderBy('created_at', 'desc')->Paginate(5);


    //     return view('home_visit_report.index', compact('homeVisitReports'));
    // }



    public function index(Request $request)
{
    $search = $request->input('search', '');

    if ($search != '') {
        // Filter by customer name or mobile number
        $homeVisitReports = HomeVisitReport::where('customer_name', 'like', '%' . $search . '%')
            ->orWhere('mobile_number', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    } else {
        // Default view without filter
        $homeVisitReports = HomeVisitReport::orderBy('created_at', 'desc')->paginate(5);
    }

    return view('home_visit_report.index', compact('homeVisitReports'));
}

}
