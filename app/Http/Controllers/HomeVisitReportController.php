<?php
namespace App\Http\Controllers;

use App\Models\HomeVisitReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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

       
    // Get SMS template and send SMS
    $message2 = app_setting('home_sms');
    send_customer_sms($request->mobile_number, $message2);
  
    

        // Redirect after saving
        return redirect()->route('homevisitreport.index')->with('success', 'Data saved successfully.');
    }


    public function index(Request $request)
{
    $search = $request->input('search', '');

    if ($search != '') {
        // Filter by customer name or mobile number
        $homeVisitReports = HomeVisitReport::where('customer_name', 'like', '%' . $search . '%')
            ->orWhere('mobile_number', 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    } else {
        // Default view without filter
        $homeVisitReports = HomeVisitReport::orderBy('created_at', 'desc')->paginate(25);
    }

    return view('home_visit_report.index', compact('homeVisitReports'));
}

}

