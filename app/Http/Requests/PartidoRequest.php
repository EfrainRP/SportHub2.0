<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartidoRequest extends FormRequest
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
        return [
            'fechaPartido' => 'required|date|after_or_equal:today',
            'horaPartido' => 'required',
            'jornada' => 'required',
            'equipoLocal_id' => 'required|different:equipoVisitante_id',
            'equipoVisitante_id' => 'required|different:equipoLocal_id',
            'resLocal' => 'required',
            'resVis' => 'required'
        ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
          return[
            'fechaPartido' => 'fecha',
            'horaPartido' => 'hora',
            'jornada' => 'jornada',
            'equipoLocal_id' => 'equipo local',
            'equipoVisitante_id' => 'equipo visitante',
          ];
    }
}
