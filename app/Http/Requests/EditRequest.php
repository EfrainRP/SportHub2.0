<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'current_password|nullable',
            'newpassword' => 'alpha_num|min:8|nullable',
            'confirmNewpassword' => 'same:newpassword',
        ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
        return[
            'name' => 'nombre',
            'fsurname' => 'tipo de juego',
            'msurname' => 'representante',
            'nickname' => 'apodo',
            'email' => 'correo',
            'password' => 'contraseña',
            'newpassword' => 'contraseña nueva',
            'confirmNewpassword' => 'confirmación de contraseña',
        ];
    }
}
