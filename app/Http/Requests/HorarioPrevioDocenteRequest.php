<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioPrevioDocenteRequest extends FormRequest
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
        
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/crear-h-p-v';
        $trabajaInstitucion = $this->input('trabajaInstitucion') == 'si';
       
        // Definir las reglas de validación basadas en la condición
        $rules = [];

        if ($trabajaInstitucion) {
            $diaRules = $esCreacion ? ['required','in:lunes,martes,miercoles,jueves,viernes'] : ['nullable','in:lunes,martes,miercoles,jueves,viernes'];
            $horaRules = $esCreacion ? ['required','date_format:H:i','before:22:20'] : ['nullable','date_format:H:i','before:22:20'];
            
            $rules = [
                'dia' => $diaRules,
                'hora' => $horaRules,
            ];
        }

        return $rules;
    }
}
