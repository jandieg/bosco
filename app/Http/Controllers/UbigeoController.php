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
      $id = $_GET['departmentid'];
      $cities = Ubigeo::getDataCities($id);
      if (!empty($cities)) {
        $options = '<option value="" default="">Ciudad</option>' . "\n";
        foreach ($cities as $key => $value) {
          $options .= '<option value="' . $key . '">' . $value . '</option>' . "\n";
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
      $id = $_GET['cityid'];
      $districts = Ubigeo::getDataDistricts($id);
      if (!empty($districts)) {
        $options = '<option value="" default="">Distrito</option>' . "\n";
        foreach ($districts as $key => $value) {
          $options .= '<option value="' . $key . '">' . $value . '</option>' . "\n";
        }
      }
      return response()->json([
        'result' => TRUE, 
        'options' => $options
      ]);
    }
  }
}
