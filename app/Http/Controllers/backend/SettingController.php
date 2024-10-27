<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use League\Csv\Reader;
use App\Models\Setting;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
  public function legendSetting()
  {
    return view('backend.settings.legends');
  }

  public function appppSetting() {
      return view('backend.settings.app_setting');
  }
  public function smssetting() {
      return view('backend.settings.sms_setting');
  }

  public function store(Request $request)
  {
    // dd($request->all());
    foreach ($request->type as $key => $type) {
      $setting = Setting::where('key', $type)->first();
      if (isset($setting)) {
        if ($request->hasFile($type)) {
          $file = $request->file($type);
          $ext = $file->getClientOriginalExtension();
          if (\file_exists(\public_path() . '/app_assets/img/' . $setting->value)) {
            @\unlink(\public_path() . '/app_assets/img/' . $setting->value);
          }
          $name = \uniqid() . '.' . $ext;
          $file->move(\public_path('app_assets'), $name);
          $setting->value = $name;
          $setting->is_image = 1;
        } else {
          $setting->value = $request->$type;
        }
        if ($request->$type) {
          $setting->save();
        }
      } else {
        $setting = new Setting();
        $setting->key = $type;
        if ($request->hasFile($type)) {
          $file = $request->file($type);
          $ext = $file->getClientOriginalExtension();
          $name = \uniqid() . '.' . $ext;
          $file->move(\public_path('app_assets'), $name);
          $setting->value = $name;
          $setting->is_image = 1;
        } else {
          $setting->value = $request->$type;
        }
        if ($request->$type) {
          $setting->save();
        }
      }
    }

    return \redirect()->back()->withSuccess("Settings Updated Successfully");
  }

  public function envSettingStore(Request $request)
  {
    foreach ($request->type as $type) {
      $this->overWriteEnvFile($type, $request->$type);
      $setting = Setting::where('key', $type)->first();
      if (isset($setting)) {
        $setting->value = $request->$type;
        $setting->save();
      } else {
        $setting = new Setting();
        $setting->key = $type;
        $setting->value = $request->$type;
        $setting->save();
      }
    }

    return \redirect()->back()->withSuccess("Settings Updated Successfully");
  }

  private function overWriteEnvFile($key, $value)
  {
    $path = app()->environmentFilePath();

    $escaped = preg_quote('=' . env($key), '/');

    file_put_contents($path, preg_replace(
      "/^{$key}{$escaped}/m",
      "{$key}={$value}",
      file_get_contents($path)
    ));
  }

  // csvImport
  public function csvImport(Request $request) {
    $file = $request->file('csv');
    $fileContents = file($file->getPathname());

    $data = [];
    $no_of_import = 0;
    for($i = 1; $i < (count($fileContents)/3); $i=$i+3) {

      $line = $fileContents[$i] . $fileContents[$i+1] . $fileContents[$i+2];
      $line = str_replace( '"', "", $line);
      $line = str_replace("\n", "", $line);
      $line = str_replace("\r", "", $line);
      $line = explode(',', $line);
      $main_user_name = explode("-", $line[0]);

      $user_id = User::where('name', 'LIKE', "%$main_user_name[1]%")->pluck('id');

      if(strlen($line[7])> 1) {
        $contents = file_get_contents(str_replace(" ", "", $line[7]));
        $ext = explode(".", str_replace(" ", "", $line[7]));
        $selfie_name = time() . '.' . end($ext);
        $save_path = public_path('/uploads/selfies/' . $selfie_name);
        file_put_contents($save_path,$contents);
      }

      if(strlen($line[8])> 1) {
        $contents = file_get_contents(str_replace(" ", "", $line[8]));
        $ext = explode(".", str_replace(" ", "", $line[8]));
        $map = time() . '.' . end($ext);
        $save_path = public_path('/uploads/map_screenshot/' . $map);
        file_put_contents($save_path,$contents);
      }

      // return $selfie_name;
      $customer = Customer::create([
        'user_id' => $user_id[0],
        'date' => $line[2],
        'name' => $line[1],
        'phone' => $line[4],
        'address' => $line[3],
        'battery_type' => $line[5],
        'comment' => $line[6],
        'selfie' => $selfie_name,
        'map' => $map,
      ]);
      $no_of_import++;
    }
    dd($no_of_import);

  }
}
