<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;

class ApiloginController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    public function login(Request $request)
    {        
    	if($request->name){
        	$user=Auth::attempt(['name'=>$request->name, 'password'=>$request->password]);
        	$user=User::where('name',$request->name)->first();
        	}
        elseif($request->email){
        	$user=Auth::attempt(['email'=>$request->email, 'password'=>$request->password]);     
        	$user=User::where('email',$request->email)->first();
        	}
        if($user) 
        {
        	$data['name']=$user->name;
        	$data['email']=$user->email;
        	$data['api_token']=$user->api_token;
        	return response()->json($data); 
        }
        else 
        	return response()->json(false);
    }
    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
        }
        return response()->json(true);
    }
}
