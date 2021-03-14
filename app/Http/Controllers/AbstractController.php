<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

abstract class AbstractController extends Controller
{
    /**
     * @OA\Info(
     *   title="Payment API",
     *   version="1.0",
     *   @OA\Contact(
     *     email="gilberto.giro.resende@gmail.com",
     *     name="Gilberto Resende"
     *   )
     * )
     */
}
