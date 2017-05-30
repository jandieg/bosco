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

    public function login($email, $password)
    {        
        $user=Auth::attempt(['email'=>$email, 'password'=>$password]);
        if($user) dd(true); else dd(false);
    }
    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
        }
        dd(false);
    }
}
