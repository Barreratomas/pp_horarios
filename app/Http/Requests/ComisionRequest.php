<?php

namespace App\Http\Requests;

use App\Models\Carrera;
use App\Models\Comision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComisionRequest extends FormRequest
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
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/comision/crear-comision';

        $id_primer_carrera=Carrera::orderBy('id_carrera')->first()->id_carrera;
        $id_ultimo_carrera=Carrera::orderBy('id_carrera','desc')->first()->id_carrera;
        
        $anioRules=$esCreacion ? ['required','integer','min:1'] : ['nullable','integer','min:1'];
        $divisionRules=$esCreacion ? ['required','integer','min:1',] : ['nullable','integer','min:1'];
        $capacidadRules=$esCreacion ? ['required','integer','min:0'] : ['nullable','integer','min:0'];

        return [
           
            'id_carrera'=> [
                'required',
                'integer',
                Rule::exists('carreras', 'id_carrera'), // Utiliza la regla exists para validar que el valor proporcionado para 'carrera' existe en la columna 'id_carrera' de la tabla 'carreras'
                'min:'.$id_primer_carrera,
                'max:'.$id_ultimo_carrera

            ],
            'anio' => $anioRules,
            'division' => $divisionRules,
            'capacidad' => $capacidadRules,
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Obtener los datos del formulario
            $anio = $this->input('anio');
            $division = $this->input('division');
            $idCarrera = $this->input('id_carrera');

            // Verificar si ya existe una comisión con el mismo año y división
            $existingComision = Comision::where('anio', $anio)
                ->where('division', $division)
                ->where('id_carrera', $idCarrera)
                ->exists();

            // Si ya existe una comisión con el mismo año y división, agregar un mensaje de error
            if ($existingComision) {
                $validator->errors()->add('anio', 'Ya existe una comisión con el mismo año y división.');
                $validator->errors()->add('division', 'Ya existe una comisión con el mismo año y división.');
            }
        });
    }
}
