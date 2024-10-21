<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\UsersController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\CustomerController;

use App\Http\Controllers\HomeVisitReportController;

Route::get('test', [CustomerController::class, 'test']);

Route::middleware(['auth'])->group(function () {
  Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

  Route::resource('customers', CustomerController::class);
  Route::get('customers-export', [CustomerController::class, 'exportPdf'])->name('customers.export-pdf');
  Route::get('reports', [CustomerController::class, 'Reports'])->name('reports');
  Route::resource('administrative', AdminController::class);

  Route::get('setting', [SettingController::class, 'legendSetting']);
  Route::post('store_setting', [SettingController::class, 'store'])->name('store_settings');
  Route::post('env_store_setting', [SettingController::class, 'envSettingStore'])->name('env_store_settings');

  
  Route::get('/homevisitreport', [HomeVisitReportController::class, 'index'])->name('homevisitreport.index');
  Route::get('/homevisitreport/create', [HomeVisitReportController::class, 'create'])->name('homevisitreport.create');
  Route::post('/homevisitreport/store', [HomeVisitReportController::class, 'store'])->name('homevisitreport.store');
  

  Route::get('app_setting', [SettingController::class, 'appppSetting'])->name('app_settings');
   Route::post('csv_import', [SettingController::class, 'csvImport'])->name('csv_import');

  Route::group(['prefix' => 'app'], function () {
    // Users routes
    Route::resource('users', UsersController::class);
    Route::get('view_user/{user_id}', [UsersController::class, 'viewUser'])->name('view_user');
    Route::get('users_list', [UsersController::class, 'ajaxList'])->name('users_list');
  });
});
