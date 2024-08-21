<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MiembroEquipoRequest extends FormRequest
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
            'user_miembro' => 'required|alpha|unique:miembro_equipos',
        ];
    }
    public function attributes(): array  //Customize the name of the attributes in the errors
    {
          return[
            'user_miembro' => 'miembro del equipo',
          ];
    }
}
