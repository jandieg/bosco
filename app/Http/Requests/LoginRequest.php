<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6'
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
