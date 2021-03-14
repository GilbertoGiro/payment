<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Client
{
    /**
     * Method to call external service (API) and retrieve formatted response
     * @param string $url - External service url
     * @param string $method - External service url method
     * @param array $parameters - Headers, specific params, etc...
     * @param int $tries - How many times we need to try communicate with external service
     * @param int $betweenTriesTimeSec - Seconds before try consume external service again
     * @param int $timeoutSec - Time before break communication with external service
     * @param null $specificValue - Specific value that you want from response
     * @return array|string
     * @throws \Exception
     */
    public function __requestWithTries(string $url, string $method, array $parameters = [], $tries = 3, $betweenTriesTimeSec = 5, int $timeoutSec = 30, $specificValue = null)
    {
        // Check if given method is valid
        $this->isValidMethod($method);
        // Call external service
        do {
            try {
                // Try communicate with external service
                return $this->__request($url, $method, $parameters, $timeoutSec, $specificValue);
            } catch (\Exception $e) {
                $tries--;
                sleep($betweenTriesTimeSec);
            }
        } while ($tries);
        // If couldn't communicate throw exception
        $this->serviceUnavailableError();
    }

    /**
     * Method to call external service with no tries
     * @param string $url - External service url
     * @param string $method - External service url method
     * @param array $parameters - Headers, specific params, etc...
     * @param int $timeoutSec - Time before break communication with external service
     * @param null $specificValue - Specific value that you want from response
     * @return array|string
     * @throws \Exception
     */
    public function __request(string $url, string $method, array $parameters = [], int $timeoutSec = 30, $specificValue = null)
    {
        return Http::timeout($timeoutSec)->{$method}($url, $parameters)->onError(function () {
            $this->serviceUnavailableError();
        })->json($specificValue);
    }

    /**
     * Method to check if given method is valid
     * @param string $method
     * @throws \Exception
     */
    private function isValidMethod(string $method)
    {
        // Check if given HTTP method is valid
        if (!in_array(strtoupper($method), ['POST', 'GET', 'PUT', 'PATCH', 'DELETE'])) {
            throw new \Exception('Given HTTP method is invalid.', 500);
        }
    }

    /**
     * Method to throw service unavailable exception
     * @throws \Exception
     */
    protected function serviceUnavailableError()
    {
        throw new \Exception('External authorizer service is unvailable.', 500);
    }
}
