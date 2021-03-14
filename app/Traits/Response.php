<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Variable who specify default error message
     * @var string
     */
    protected $defaultMessage = 'Serviço indisponivel. Tente novamente mais tarde.';

    /**
     * Method to treat response message
     * @param string $message
     * @return JsonResponse
     */
    public function successJsonResponse(string $message): JsonResponse
    {
        return response()->json([
            'code' => 200,
            'message' => $message
        ]);
    }

    /**
     * Method to treat exception, log error and retrieve formatted response
     * @param \Exception $e
     * @param null|string $customMessage
     * @return JsonResponse
     */
    public function errorJsonResponse(\Exception $e, $customMessage = null): JsonResponse
    {
        return response()->json([
            'code' => 500,
            'message' => ($customMessage) ?: $this->defaultMessage
        ]);
    }
}
