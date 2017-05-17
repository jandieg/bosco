<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Subscriber;


class SubscriptionController extends Controller
{
    public function index(SubscriptionRequest $request)
    {
        if($request->isMethod('POST'))
        {
            $subscriber = new Subscriber();
            $subscriber->email = $request->get('email');
            $subscriber->save();
            return response()->json(['status'=>true,'message'=>'Gracias por suscribirse.']);
        }
    }
}
