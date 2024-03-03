<?php

namespace App\Http\Requests;

use App\Models\Aula;
use App\Models\Carrera;
use App\Models\Comision;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteMateriaRequest extends FormRequest
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
        $esCreacion = $this->url() == 'http://127.0.0.1:8000/docente-materia/crear-docente-materia';
        
        $id_primer_comision = Comision::orderBy('id_comision')->first()->id_comision;
        $id_ultimo_comision = Comision::orderBy('id_comision', 'desc')->first()->id_comision;
        
        $id_primer_carrera=Carrera::orderBy('id_carrera')->first()->id_carrera;
        $id_ultimo_carrera=Carrera::orderBy('id_carrera','desc')->first()->id_carrera;

        $id_primer_aula=Aula::orderBy('id_aula')->first()->id_aula;
        $id_ultimo_aula=Aula::orderBy('id_aula','desc')->first()->id_aula;

        $idCarreraRules = $esCreacion ? ['required', 'integer', Rule::exists('carreras', 'id_carrera'),'min:'.$id_primer_carrera,'max:'.$id_ultimo_carrera] : ['nullable', 'integer', Rule::exists('carreras', 'id_carrera'),'min:'.$id_primer_carrera,'max:'.$id_ultimo_carrera];
        $idComisionRules = $esCreacion ? ['required', 'integer', Rule::exists('comisiones', 'id_comision'), 'min:' . $id_primer_comision,'max:' . $id_ultimo_comision ] : ['nullable', 'integer', Rule::exists('comisiones', 'id_comision'), 'min:' . $id_primer_comision,'max:' . $id_ultimo_comision ];
        $idAulasRules = $esCreacion ? ['required', 'integer', Rule::exists('aulas', 'id_aula'), 'min:' . $id_primer_aula,'max:' . $id_ultimo_aula ] : ['nullable', 'integer', Rule::exists('comisiones', 'id_comision'), 'min:' . $id_primer_aula,'max:' . $id_ultimo_aula];

        return [
            'id_materia' =>$idCarreraRules,
            'id_comision' => $idComisionRules,
            'id_aula' => $idAulasRules,




        ];
    }
}
