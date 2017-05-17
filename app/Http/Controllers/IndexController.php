<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
	public function index()
	{			
		return view('general.page-index',['user'=>Auth::check()?Auth::user():null]);
  }
	public function getContactUs()
	{			
		return view('general.page-contact-us',['user'=>Auth::check()?Auth::user():null]);
  }
	public function getTermsConditions()
	{			
		return view('general.page-terms-conditions',['user'=>Auth::check()?Auth::user():null]);
  }
  public function getHelp()
  {

    return view('general.page-help',['user'=>Auth::check()?Auth::user():null]);
  }
}
