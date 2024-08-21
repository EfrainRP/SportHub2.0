<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|alpha|max:60',
            'fsurname' => 'required|alpha|max:60',
            'msurname' => 'required|alpha|max:60',
            'nickname' => 'required|alpha_num|max:50',
            'gender' => ['required', 'in:male,female,non-binary'],
            'birthdate' => 'required|date',
            'email' => 'required|unique:users,email',
            'password' => 'required|alpha_num|min:8',
            'confirmpassword' => 'required|alpha_num|same:password|',
        ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
          return[
            'name' => 'nombre',
            'fsurname' => 'tipo de juego',
            'msurname' => 'representante',
            'nickname' => 'apodo',
            'gender' => 'género',
            'birthdate' => 'fecha de nacimiento',
            'email' => 'correo',
            'password' => 'contraseña',
            'confirmpassword' => 'confirmación de contraseña',
          ];
    }
}
