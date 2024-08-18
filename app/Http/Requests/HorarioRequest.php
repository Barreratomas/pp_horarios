<?php

namespace App\Http\Requests;

use App\Models\Carrera;
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
        $id_primer_comision = Comision::orderBy('id_comision')->first()->id_comision;
        $id_ultimo_comision = Comision::orderBy('id_comision', 'desc')->first()->id_comision;
        
       

        return [
            'comision' => [
                'required',
                'integer',
                Rule::exists('comisiones', 'id_comision'), // Utiliza la regla exists para validar que el valor proporcionado para 'comision' existe en la columna 'id_comision' de la tabla 'comisiones'
                'min:' . $id_primer_comision,
                'max:' . $id_ultimo_comision
                
                
            ],
          
        ];
    }
}
