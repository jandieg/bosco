<?php

namespace App\Http\Controllers;

use App\Ubigeo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ubigeoController extends Controller
{
  public function getUbigeoCity(Request $request)
  {
    if ($request->isMethod('get')){
      $val = $_GET['department'];
      $cities = Ubigeo::getDataCities($val);
      if (!empty($cities)) {
        $options = '<option value="" default="">Ciudad</option>' . "\n";
        foreach ($cities as $key => $value) {
          $options .= '<option value="' . $value['city'] . '">' . $value['city'] . '</option>' . "\n";
        }
      }
      return response()->json([
        'result' => TRUE, 
        'options' => $options
      ]);
    }
  }

  public function getUbigeoDistrict(Request $request)
  {
    if ($request->isMethod('get')){
      $val = $_GET['city'];
      $districts = Ubigeo::getDataDistricts($val);
      if (!empty($districts)) {
        $options = '<option value="" default="">Distrito</option>' . "\n";
        foreach ($districts as $key => $value) {
          $options .= '<option value="' . $value['district'] . '">' . $value['district'] . '</option>' . "\n";
        }
      }
      return response()->json([
        'result' => TRUE, 
        'options' => $options
      ]);
    }
  }
}
