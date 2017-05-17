<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function index()
	{			
		return view('services.page-functioning-index',['user'=>Auth::check()?Auth::user():null]);
    }
    public function getFunctioningWeb()
    {
       return view('services.page-functioning-web',['user'=>Auth::check()?Auth::user():null]);
    }
    public function getFunctioningApp()
    {
      return view('services.page-functioning-app',['user'=>Auth::check()?Auth::user():null]);
    }
}