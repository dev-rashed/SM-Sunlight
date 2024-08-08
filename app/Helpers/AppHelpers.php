<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

function app_setting($setting) {
  $setting = Setting::where('key', $setting)->first();
  if (isset($setting)) {
    if ($setting->is_image == 0) {
      $setting = isset($setting) ? $setting->value : "";
    } else {
      $setting = isset($setting) ? '/app_assets/' . $setting->value : "";
    }
  } else {
    $setting = '';
  }
  return $setting;
}


function getImageUrl($image, $size = 'original') {
    $path = 'images';

    if ($size === 'thumbnail') {
        $path .= '/thumbnails';
    }

    return Storage::url($path . '/' . $image);
}



function sms_send($number, $message) {
  $url = "http://bulksmsbd.net/api/smsapi";
  $api_key = "ekUvupTbECfsUzGiXEC4";
  // $senderid = 8809617614306;
  $senderid = "SM SUNLIGHT";


  $data = [
      "api_key" => $api_key,
      "senderid" => $senderid,
      "number" => $number,
      "message" => $message,
  ];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $response = curl_exec($ch);
  curl_close($ch);
  Log::info($response);
  return $response;
}
