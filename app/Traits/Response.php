<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    /**
     * Variable who contains default response code
     * @var int
     */
    protected $defaultResponseCode = 500;

    /**
     * Variable who specify response messages (Treated)
     * @var string[]
     */
    protected $messages = [
        401 => 'Ação não autorizada.',
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
        $responseCode = $this->getResponseCode($e);
        return response()->json([
            'code' => $responseCode,
            'message' => ($customMessage) ?: $this->getResponseMessage($e)
        ], $responseCode);
    }

    /**
     * Method to check if error message was set in default response messages
     * @param \Exception $e
     * @return bool
     */
    private function isValidResponseCode(\Exception $e): bool
    {
        return array_key_exists($e->getCode(), $this->messages);
    }

    /**
     * Method to get response code
     * @param \Exception $e
     * @return int
     */
    private function getResponseCode(\Exception $e): int
    {
        return ($this->isValidResponseCode($e))
            ? $e->getCode()
            : $this->defaultResponseCode;
    }

    /**
     * Method to get treated response message
     * @param \Exception $e
     * @return string
     */
    private function getResponseMessage(\Exception $e): string
    {
        return ($this->isValidResponseCode($e))
            ? $this->messages[$e->getCode()]
            : $this->messages[$this->defaultResponseCode];
    }
}
