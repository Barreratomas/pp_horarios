<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *     title="Planificacion Horaria",
 *     version="1.0.0",
 *     description="Gestion de horarios de clases",
 *     @OA\Contact(
 *         email="contacto@tudominio.com"
 *    ),
 *     @OA\License(
 *     name="Licencia",
 *     url="https://www.terciarioUrquiza.com.ar/planificacionHoraria"
 *   )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
