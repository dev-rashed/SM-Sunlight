<?php

namespace App\Http\Controllers;

use App\Models\InstituteVisitReport;
use Illuminate\Http\Request;

class InstituteVisitReportController extends Controller
{
    // Show the form
    public function create()
    {
        return view('institute_visit_report.create');
    }

    // Store the form data
    public function store(Request $request)
    {
        $request->validate([
            'institute_name' => 'required',
            'institute_location' => 'required',
            'teachers_name' => 'required',
            'teachers_mobile_number' => 'required|unique:institute_visit_reports',
            'teachers_quantity' => 'required|integer',
            'students_quantity' => 'required|integer',
            'home_appliance_have_f' => 'required',
            'home_appliance_not_have_f' => 'required',
            'remarks' => 'required',
            'created_at',
            'updated_at',
        ]);

        // Store data in the database
        InstituteVisitReport::create($request->all());

        return redirect()->route('institutevisitreport.index')
                         ->with('success', 'Report added successfully!');
    }

    // Show all reports
    public function index()
    {
        $instituteVisitReport = InstituteVisitReport::all();
        return view('institute_visit_report.index', compact('instituteVisitReport'));
    }
}
