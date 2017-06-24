<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Email;


class SubscriptionController extends Controller
{
    public function index(SubscriptionRequest $request)
    {
        if($request->isMethod('POST'))
        {                    
            $email = new Email();
            $email->email = $request->get('email');
            $email->save();
            return response()->json(['status'=>true,'message'=>'Gracias por suscribirse.']);        
        }
    }
}
