<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class TorneoRequest extends FormRequest
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
        return [ //Validations Torneo
            'name' => 'required|min:3|unique:torneos',
            'tipoJuego' => 'required',
            'ubicacion'=>'required',
            'fechaInicio' => 'required|date|after_or_equal:yesterday',
            'fechaFin' => 'required|date|after_or_equal:fechaInicio',
            'tipoTorneo' => 'required|in:Individual,Equipos',
            'cantEquipo'=>'required|numeric|gt:3',
        ];
    }

    public function messages(): array  //Customize the field error message 
    {
          return[
            'fechaInicio.after_or_equal' => 'La fecha de inicio del torneo debe ser mayor a la actual.',
            'cantEquipo.gt' => 'La cantidad de miembros aceptada para crear un torneo debe ser mínimo de 4',
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
          return [ 
            'name' => 'nombre',
            'ubicacion'=> 'ubicación',
            'tipoJuego' => 'tipo de juego',
            'fechaInicio' => 'fecha de inicio',
            'fechaFin' => 'fecha de finalización',
            'tipoTorneo' => 'tipo de torneo',
            'cantEquipo'=> 'cantidad de miembros'
        ];
    }
}
