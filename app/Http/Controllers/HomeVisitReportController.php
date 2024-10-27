<?php
namespace App\Http\Controllers;

use App\Models\HomeVisitReport;
use Illuminate\Http\Request;

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

    public function index()
    {
        // Get all data from the database
        $homeVisitReports = HomeVisitReport::all();

        return view('home_visit_report.index', compact('homeVisitReports'));
    }
}
