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
        
        
        $id_primer_carrera=Carrera::orderBy('id_carrera')->first()->id_carrera;
        $id_ultimo_carrera=Carrera::orderBy('id_carrera','desc')->first()->id_carrera;
        
        $dniRules = $esCreacion ? ['required', 'integer', 'min:1', Rule::unique('usuarios', 'dni')] : [];
        $nombreRules=$esCreacion ? ['required', 'string'] : ['nullable','string'];
        $apellidoRules=$esCreacion ? ['required', 'string'] : ['nullable','string'];
        $tipoRules = $esCreacion ? ['required', 'in:estudiante,bedelia'] : ['nullable', 'in:estudiante,bedelia'];
        $emailRules=$esCreacion ? ['required', 'email'] : ['nullable', 'email'];
        $idCarreraRules = $esCreacion ? ['required', 'integer', Rule::exists('carreras', 'id_carrera'),  'min:'.$id_primer_carrera,'max:'.$id_ultimo_carrera] : ['nullable', 'integer', Rule::exists('carreras', 'id_carrera'),  'min:'.$id_primer_carrera,'max:'.$id_ultimo_carrera];
        $anioRules = $esCreacion ? ['required', 'integer', 'min:1', 'max:9'] : [];

        

        return [
            'dni' => $dniRules,
            'nombre' => $nombreRules,
            'apellido' => $apellidoRules,
            'tipo' => $tipoRules,
            'email' => $emailRules,
            'id_carrera' => $idCarreraRules,
            'anio' => $anioRules,
            
        ];
    }
}
