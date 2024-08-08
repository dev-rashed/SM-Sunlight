<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\NewApplicationMail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
        if(auth()->user()->role == 'admin') {
          $customers = Customer::with('addedBy')->get();
        } else {
          $customers = Customer::where('user_id', auth()->user()->id)->with('addedBy')->get();
        }

          return DataTables::of($customers)
            ->addIndexColumn()
            ->addColumn('status', function ($customer) {
              $html = '<small>' . $customer->created_at . '</small><br>';
              return $html;
            })
            ->addColumn('added_by', function ($customer) {
              return isset($customer->addedBy) ? $customer->addedBy->name : 'Not Exist';
            })
            ->addColumn('action', function ($customer) {
              $html = '<div class="btn-group" role="group" aria-label="Basic example">';
              if(auth()->user()->role == 'admin') {
                  $html .= '<a href="' . route('customers.edit', $customer->id) . '" class="btn px-2 btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>';
              }
              $html .= '<a href="'. route('customers.show', $customer->id) .'" class="btn px-2 btn-secondary"><i class="fa-regular fa-eye"></i></a>';
              if(auth()->user()->role == 'admin') {
                $html .='<a type="button" data-id="'. $customer->id .'" class="btn px-2 btn-danger text-white open_delete_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></a>';
              }
              $html .= '</div>';
              return $html;
            })
            ->rawColumns(['status', 'added_by', 'action'])
            ->make(true);
    }

    return new Response(view('backend.customers.index'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('backend.customers.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $rules = [
      'phone' => 'required|unique:customers',
      'selfie_with_customer' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
      'map_screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ];

    $validate = Validator::make($request->all(), $rules);

    if ($validate->fails()) {
      return \redirect()
        ->back()
        ->withErrors($validate)
        ->withInput();
    }

    $customer = new Customer();
    $customer->user_id = auth()->user()->id;
    $customer->name = $request->full_name;
    $customer->date = $request->date;
    $customer->address = $request->address;
    $customer->phone = $request->phone;
    $customer->battery_type = $request->battery_type;
    $customer->comment = $request->comment;

    if ($request->hasFile('selfie_with_customer')) {
      $image = $request->file('selfie_with_customer');
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path('/selfies');
      $image->move($destinationPath, $name);
      $customer->selfie = $name;
    }

    if ($request->hasFile('map_screenshot')) {
      $image = $request->file('map_screenshot');
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path('/map_screenshot');
      $image->move($destinationPath, $name);
      $customer->map = $name;
    }

    $customer->save();

    try {
      Mail::to(auth()->user()->email)->send(new NewApplicationMail($customer));
    } catch (\Throwable $th) {
      //throw $th;
    }

    $user = User::with('store')->where('id', auth()->user()->id)->first();
    $message = app_setting('customer_sms');

    $message = str_replace('{sales_name}', $user->name, $message);
    $message = str_replace('{sales_phone}', $user->phone, $message);
    $message = str_replace('{store_name}', $user->store ? $user->store->name : "", $message);
    $message = str_replace('{store_phone}', $user->store ? $user->store->phone : "", $message);
    $message = str_replace('{store_address}', $user->store ? $user->store->address : "", $message);

    sms_send($request->phone, $message);

    return \redirect()
      ->route('customers.index')
      ->withSuccess('Application submitted successfully');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $customer = Customer::where("id", $id)->with('addedBy')->first();
    return view('backend.customers.show', \get_defined_vars());
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $customer = Customer::where("id", $id)->with('addedBy')->first();
    return view('backend.customers.edit', \get_defined_vars());
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function update(Request $request, $id)
  {
    $rules = [
      'phone' => 'required|unique:customers,phone,' . $id,
      'selfie_with_customer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
      'map_screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ];

    $validate = Validator::make($request->all(), $rules);

    if ($validate->fails()) {
      return \redirect()
        ->back()
        ->withErrors($validate)
        ->withInput();
    }

    $customer = Customer::find($id);
    $customer->name = $request->full_name;
    $customer->date = $request->date;
    $customer->address = $request->address;
    $customer->phone = $request->phone;
    $customer->battery_type = $request->battery_type;
    $customer->comment = $request->comment;

    if ($request->hasFile('selfie_with_customer')) {
      @unlink(public_path('/selfies/' . $customer->selfie));

      $image = $request->file('selfie_with_customer');
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path('/selfies');
      $image->move($destinationPath, $name);
      $customer->selfie = $name;
    }

    if ($request->hasFile('map_screenshot')) {
      @unlink(public_path('/map_screenshot/' . $customer->map));
      $image = $request->file('map_screenshot');
      $name = time() . '.' . $image->getClientOriginalExtension();
      $destinationPath = public_path('/map_screenshot');
      $image->move($destinationPath, $name);
      $customer->map = $name;
    }

    $customer->save();

    return \redirect()
      ->back()
      ->withSuccess('Customer updated successfully');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $customer = Customer::find($id);
    @unlink(public_path('/selfies/' . $customer->selfie));
    @unlink(public_path('/map_screenshot/' . $customer->map));
    $customer->delete();
    return response()->json(['success' => true, 'message' => 'Customer deleted successfully']);
  }

  public function Reports(Request $request) {
        if(auth()->user()->role == 'admin') {
          $users = User::with('customers')->get();
          $reports = [];
          foreach ($users as $user) {
               if (stripos($user->name, 'admin') !== false || stripos($user->username, 'admin') !== false || stripos($user->email, 'admin') !== false) {
                    continue;
                }
                $report = [
                    'name' => $user->name,
                    'customers_today' => $user->customers()->whereDate('created_at', today())->count(),
                    'customers_yesterday' => $user->customers()->whereDate('created_at', today()->subDay())->count(),
                    'customers_this_week' => $user->customers()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'customers_this_month' => $user->customers()->whereMonth('created_at', now()->month)->count(),
                    'customers_lifetime' => $user->customers()->count(),
                ];
                $reports[] = $report;
            }
        }

      if ($request->ajax()) {
          return DataTables::of($reports)
            ->addIndexColumn()
            ->addColumn('name', function ($report) {
                $html = "<div class=''>" .  $report['name'] . "</div>";
                return $html;
            })
            ->addColumn('today', function ($report) {
               $html = "<div class='text-center'>" .  $report['customers_today'] . "</div>";
                return $html;
            })
            ->addColumn('yesterday', function ($report) {
                $html = "<div class='text-center'>" .  $report['customers_yesterday'] . "</div>";
                return $html;
            })
            ->addColumn('last_week', function ($report) {
                $html = "<div class='text-center'>" .  $report['customers_this_week'] . "</div>";
                return $html;
            })
            ->addColumn('last_month', function ($report) {
                $html = "<div class='text-center'>" .  $report['customers_this_month'] . "</div>";
                return $html;
            })
            ->addColumn('total', function ($report) {
                $html = "<div class='text-center'>" . $report['customers_lifetime'] . "</div>";
                return $html;
            })
            ->rawColumns(['name', 'today', 'yesterday', 'last_week', 'last_month', 'total' ])
            ->make(true);
    }

    return new Response(view('backend.customers.reports'));
  }

    public function exportPdf() {
        $users = User::with('customers')->get();
        $reports = [];
        foreach ($users as $user) {
          if (stripos($user->name, 'admin') !== false || stripos($user->username, 'admin') !== false || stripos($user->email, 'admin') !== false) {
                continue;
            }
            $report = [
                'name' => $user->name,
                'customers_today' => $user->customers()->whereDate('created_at', today())->count(),
                'customers_yesterday' => $user->customers()->whereDate('created_at', today()->subDay())->count(),
                'customers_this_week' => $user->customers()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'customers_this_month' => $user->customers()->whereMonth('created_at', now()->month)->count(),
                'customers_lifetime' => $user->customers()->count(),
            ];
            $reports[] = $report;
        }

        $pdf = Pdf::loadView('backend.customers.export-pdf', ['data' => $reports]);

        return $pdf->download(time(). '.pdf');
    }

}
