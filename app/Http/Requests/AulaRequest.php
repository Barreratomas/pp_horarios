<?php

namespace App\Http\Requests;

use App\Models\Aula;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AulaRequest extends FormRequest
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
        
        
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/aula/crear-aula';

        


        $nombreRules = $esCreacion ? ['required','string','max:255',Rule::unique('aulas')] : ['nullable','string','max:255',Rule::unique('aulas')];
        $capacidadRules = $esCreacion ? ['required' , 'integer' ,'min:0'] :[ 'nullable ', 'integer ', 'min:0'];
        $tipoAulaRules = $esCreacion ? ['required ',' string' ]:[ 'nullable ',' string'];


        return [
            'nombre' => $nombreRules,

            'capacidad' => $capacidadRules,

            'tipo_aula' => $tipoAulaRules,

        ];
    }
}
