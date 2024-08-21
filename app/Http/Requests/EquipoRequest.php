<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipoRequest extends FormRequest
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
        return [ //Validations Equipo
            'name' => 'required|min:3|unique:equipos',
            'tipoJuego' => 'required',
        ];
    }

    public function messages(): array  //Customize the field error message 
    {
          return[
            /*
            'name.required' => 'El nombre del equipo es obligatorio',
            'name.min:3' => 'El nombre del equipo debe contener al menos 3 caracteres.',
            'tipoJuego.required' => 'El tipo de juego es obligatorio',
            'user_id.required' => 'El nombre del representante es obligatorio',
            */
          ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
          return[
            'name' => 'nombre',
            'tipoJuego' => 'tipo de juego',
            'user_id' => 'representante'
          ];
    }
}
