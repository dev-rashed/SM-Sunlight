<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
      return view('backend.dashboard.index', \get_defined_vars());
    }
    public function index(Request $request)
    {
      if($request->ajax()) {
        $users = DB::table('users')->get();
        return DataTables::of($users)
          ->addIndexColumn()
          ->addColumn('action', function($user) {
            $html = '<a href="'.route('administrative.edit', $user->id).'" class="me-1"><i class="bx bx-edit"></i></a>';
            return $html;
          })
          ->addColumn('role', function($user) {
            return "<span class='badge bg-primary'>".ucfirst($user->role)."</span>";
          })
          ->rawColumns(['action', 'role'])
          ->make(true);
       };
      return \view('backend.admins.index');
    }


    public function create()
    {
      $stores = DB::table('stores')->get();
        return view('backend.admins.create', compact('stores'));
    }

    public function store(Request $request)
    {
      $rules = [
        'full_name' => 'required',
        'user_name' => 'required|unique:users',
        'email' => 'required|unique:users',
        'phone' => 'required|unique:users',
        'password' => 'required|confirmed',
        'role' => 'required',
      ];

      $validate = \validator($request->all(), $rules);
      if($validate->fails()) {
        return \redirect()->back()->withErrors($validate)->withInput();
      }

      $admin = User::create([
        'store_id' => $request->store,
        'name' => $request->full_name,
        'user_name' => $request->user_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'created_at' => \now()
      ]);
      return \redirect()->route('administrative.index')->withSuccess('Admin added successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $stores = DB::table('stores')->get();
        $admin = User::find($id);
        return view('backend.admins.edit', \get_defined_vars());
    }

    public function update(Request $request, $id)
    {
      $rules = [
        'full_name' => 'required',
        'email' => 'required|unique:users,email,'.$id,
        'phone' => 'required|unique:users,phone,'.$id,
        'role' => 'required',
      ];

      $validate = \validator($request->all(), $rules);

      if($validate->fails()) {
        return \redirect()->back()->withErrors($validate)->withInput();
      }


      $admin = User::find($id);
      $admin->store_id = $request->store;
      $admin->name = $request->full_name;
      $admin->email = $request->email;
      $admin->phone = $request->phone;
      $admin->role = $request->role;

      if(isset($request->password) && $request->password == $request->password_confimation) {
        $admin->password = Hash::make($request->password);
      }
      $admin->save();

      return \redirect()->route('administrative.index')->withSuccess('Admin updated successfully');
    }

    public function destroy($id)
    {
       $admin = User::find($id);
       $admin->delete();
       return \redirect()->route('administrative.index')->withSuccess("User removed successfully");
    }
}
