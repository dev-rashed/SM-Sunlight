<?php
namespace App\Http\Controllers;

use App\Models\HomeVisitReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class HomeVisitReportController extends Controller
{
    public function create()
    {
        return view('home_visit_report.create');
    }

    public function store(Request $request)
    {
        // Validate form inputs
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
        ]);

        // Store the data in the database
        HomeVisitReport::create($request->all());


        // Send SMS to customer
        $message = app_setting('home_sms');
        send_customer_sms($request->mobile_number, $message);




        // Redirect after saving
        return redirect()->route('homevisitreport.index')->with('success', 'Data saved successfully.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $query = HomeVisitReport::orderBy('created_at', 'desc');

        if (!empty($search)) {
            // Apply search filters
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%$search%")
                    ->orWhere('mobile_number', 'like', "%$search%")
                    ->orWhere('occupation', 'like', "%$search%")
                    ->orWhere('village_name', 'like', "%$search%")
                    ->orWhere('union_name', 'like', "%$search%")
                    ->orWhere('thana', 'like', "%$search%")
                    ->orWhere('district', 'like', "%$search%");
            });
        }

        $homeVisitReports = $query->paginate(10);

        return view('home_visit_report.index', compact('homeVisitReports'));
    }
    public function stats()
    {
        // Calculate the statistics
        $todayCount = HomeVisitReport::whereDate('created_at', today())->count();
        $yesterdayCount = HomeVisitReport::whereDate('created_at', now()->subDay())->count();
        $lastWeekCount = HomeVisitReport::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $lastMonthCount = HomeVisitReport::whereBetween('created_at', [now()->subMonth(), now()])->count();
        $totalCount = HomeVisitReport::count();

        return view('home_visit_report_statas', compact('todayCount', 'yesterdayCount', 'lastWeekCount', 'lastMonthCount', 'totalCount'));
    }






    public function exportPdf()
    {
        $todayCount = HomeVisitReport::whereDate('created_at', today())->count();
        $yesterdayCount = HomeVisitReport::whereDate('created_at', now()->subDay())->count();
        $lastWeekCount = HomeVisitReport::whereBetween('created_at', [now()->subWeek(), now()])->count();
        $lastMonthCount = HomeVisitReport::whereBetween('created_at', [now()->subMonth(), now()])->count();
        $totalCount = HomeVisitReport::count();

        $pdf = PDF::loadView('pdf.home_visit_report_statas', compact('todayCount', 'yesterdayCount', 'lastWeekCount', 'lastMonthCount', 'totalCount'));

        // Download the PDF
        return $pdf->download('home_visit_report_statistics.pdf');
    }



}
