<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SubscriptionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:emails,email'
        ];
    }

    public function messages()
    {
        return [
            "required"=>":attribute es obligatorio",
            "email"=>":attribute no es válido",
            "unique"=>":attribute ya ha sido suscrito"
        ];
    }

    public function response(array $errors)
    {
        if($this->ajax()){
            return response()->json([
                'status'=>false,
                'errors'=>array_flatten($errors)
            ]);
        }
    }


}
