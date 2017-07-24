<?php

namespace App\Http\Controllers;

use App\Report;
use App\Ubigeo;
use App\Correo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IndexController extends Controller {

    public function index() {
        $parameters = array(
            'userid' => FALSE
        );
        $reports = Report::getPublicReports($parameters, TRUE, 20, 'mascotas/perdidos');
        $departments = Ubigeo::getDataDepartments();
        $cities = Ubigeo::getDataCities(null);
        $districts = Ubigeo::getDataDistricts(null);
        return view('general.page-index',
                [
                'reports' => $reports,
                'departments'=>$departments,
                'cities'=>$cities,
                'districts'=>$districts,
                'user' => Auth::check() ? Auth::user() : null
                ]);
    }

    public function getContactUs() {
        return view('general.page-contact-us', ['user' => Auth::check() ? Auth::user() : null]);
    }

    public function postContactMail(Request $request) {
        $nombre  = $request->get('nombre_contacto');
        $email   = $request->get('email_contacto');
        $mensaje = $request->get('mensaje_contacto');
        $resp = (new Correo)->enviarContacto($nombre, $mensaje, $email);
        return response()->json(TRUE);
    } 

    public function getTermsConditions() {
        return view('general.page-terms-conditions', ['user' => Auth::check() ? Auth::user() : null]);
    }

    public function getPoliticsAndPrivacy() {
        return view('general.page-politicas', ['user' => Auth::check() ? Auth::user() : null]);
    }

    public function getHelp() {

        return view('general.page-help', ['user' => Auth::check() ? Auth::user() : null]);
    }

}
