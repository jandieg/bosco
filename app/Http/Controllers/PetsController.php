<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Ubigeo;
use App\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetsController extends Controller {

    public function getPetsLost() {
        $parameters = array(
            'status' => 'lost',
            'userid' => FALSE
        );
        $reports = Report::getDataReports($parameters, TRUE, 10, 'mascotas/perdidos');
        return view('pets.page-pets-lost', [
            'reports' => $reports,
                'user' => Auth::check() ? Auth::user() : null
                ]   
        );
    }

    public function getPetsFound(Request $request) {
        $parameters = array(
            'status' => 'found',
            'userid' => FALSE
        );
        $reports = Report::getDataReports($parameters, TRUE, 10, 'mascotas/perdidos');
        return view('pets.page-pets-lost', [
            'reports' => $reports,
                'user' => Auth::check() ? Auth::user() : null
                ]   
        );
    }

    public function getPetsDetail(Request $request) {
        $id = $request->get('petid');
        $status = $request->get('status');
        $pet = Pet::getDataPet($id, $status);

        return response()->json([
                    'result' => TRUE,
//                    'path' => url(''),
                    'pet' => $pet
        ]);
    }

    public function postPetsLost(Request $request) {
        $parameters = array(
            'status' => 'lost',
            'userid' => FALSE,
            'department' => $request->get('department', null),
            'province' => $request->get('province', null),
            'district' => $request->get('district', null)
        );

        return response()->json([
                    'status' => TRUE,
                    'reports' => Report::getDataReports($parameters, TRUE, 10, 'mascotas/perdidos')
        ]);
    }

}
