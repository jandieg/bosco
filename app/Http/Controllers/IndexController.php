<?php

namespace App\Http\Controllers;

use App\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller {

    public function index() {
        $parameters = array(
            'userid' => FALSE
        );
        $reports = Report::getDataReports($parameters, TRUE, 50, 'mascotas/perdidos');
        return view('general.page-index',
                [
                'reports' => $reports,
                'user' => Auth::check() ? Auth::user() : null
                ]);
    }

    public function getContactUs() {
        return view('general.page-contact-us', ['user' => Auth::check() ? Auth::user() : null]);
    }

    public function getTermsConditions() {
        return view('general.page-terms-conditions', ['user' => Auth::check() ? Auth::user() : null]);
    }

    public function getHelp() {

        return view('general.page-help', ['user' => Auth::check() ? Auth::user() : null]);
    }

}
