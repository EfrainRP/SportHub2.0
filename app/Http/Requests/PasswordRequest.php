<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ //Validations User
            'token'=>'required',
            'email'=>'required|email',
            'password' => 'required|alpha_num|min:8',
            'confirmpassword' => 'required|alpha_num|same:password|',
        ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
          return[
            'confirmpassword' => 'confirmación de contraseña',
          ];
    }
    public function messages()
    {
        return[
           'token.required'=> 'La solicitud de restablecimiento de contraseña ha expirado.',
        ];
    }
}
