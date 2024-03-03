<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteRequest extends FormRequest
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

        $esCreacion = $this->url() == 'http://127.0.0.1:8000/docente/crear-docente';

        $dniRules = $esCreacion ? ['required', 'integer', 'min:1', Rule::unique('docentes', 'dni')] : [];
        $nombreRules=$esCreacion ? ['required', 'string'] : ['nullable','string'];
        $apellidoRules=$esCreacion ? ['required', 'string'] : ['nullable','string'];
        $emailRules=$esCreacion ? ['required', 'email'] : ['nullable', 'email'];


        return [
            'dni' =>$dniRules,
            'nombre' => $nombreRules,
            'apellido' => $apellidoRules,
            'email' => $emailRules,
        ];
    }
}
