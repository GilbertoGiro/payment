<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Variable who contains default messages for
     * @var string[]
     */
    protected $messages = [
        500 => 'Serviço indisponivel. Tente novamente mais tarde.'
    ];

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
            'code' => $e->getCode(),
            'message' => ($customMessage) ?: $this->messages[$e->getCode()]
        ]);
    }
}
