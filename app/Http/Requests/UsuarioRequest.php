<?php

namespace App\Http\Requests;

use App\Models\Carrera;
use App\Models\Comision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UsuarioRequest extends FormRequest
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
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/usuario/crear-usuario';
        
        
        $rules = [
            'dni' => $esCreacion ? ['required', 'integer', 'min:1', Rule::unique('usuarios', 'dni')] : [],
            'nombre' => $esCreacion ? ['required', 'string'] : ['nullable', 'string'],
            'apellido' => $esCreacion ? ['required', 'string'] : ['nullable', 'string'],
            'tipo' => $esCreacion ? ['required', 'in:estudiante,bedelia,admin'] : ['nullable', 'in:estudiante,bedelia.admin'],
            'email' => $esCreacion ? ['required', 'email'] : ['nullable', 'email'],
        ];
        

        if ($this->input('tipo') == 'estudiante') {
            $id_primer_carrera = Carrera::orderBy('id_carrera')->first()->id_carrera;
            $id_ultimo_carrera = Carrera::orderBy('id_carrera', 'desc')->first()->id_carrera;
            $rules['id_carrera'] = $esCreacion ? ['required', 'integer', Rule::exists('carreras', 'id_carrera'), 'min:' . $id_primer_carrera, 'max:' . $id_ultimo_carrera] : ['nullable', 'integer', Rule::exists('carreras', 'id_carrera'), 'min:' . $id_primer_carrera, 'max:' . $id_ultimo_carrera];
            $rules['anio'] = $esCreacion ? ['required', 'integer', 'min:1', 'max:9'] : ['nullable', 'integer', 'min:1', 'max:9'];
        } else {
            $rules['id_carrera'] = ['nullable'];
            $rules['anio'] = ['nullable'];
        }
    
        return $rules;
    }
}
