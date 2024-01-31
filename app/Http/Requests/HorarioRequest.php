<?php

namespace App\Http\Requests;

use App\Models\Comision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HorarioRequest extends FormRequest
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
        $id_primero = Comision::orderBy('id_comision', 'asc')->first()->id_comision;
        $id_ultimo = Comision::orderBy('id_comision', 'desc')->first()->id_comision;
        return [
            'comision' => [
                'required',
                'integer',
                Rule::exists('comisiones', 'id_comision'), // Asegúrate de ajustar el nombre de la tabla si es diferente
                'min:' . $id_primero,
                'max:' . $id_ultimo,
                
                
            ],
        ];
    }
}
