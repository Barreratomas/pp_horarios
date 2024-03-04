<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MateriaRequest extends FormRequest
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
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/materia/crear-materia';


        $nombreRules = $esCreacion ? ['required','string','max:255',Rule::unique('materias')] : ['nullable','string','max:255',Rule::unique('materias')];
        $modulos_semanalesRules=$esCreacion ? ['required','integer','min:1','max:6'] : ['nullable','integer','min:1','max:6'];


        return [
            'nombre' => $nombreRules,
            'modulos_semanales' => $modulos_semanalesRules,        

        ];
    }
}
