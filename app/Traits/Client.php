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
     * @param int $betweenTriesTime - Seconds before try consume external service again
     * @param null $specificValue - Specific value that you want from response
     * @return array|string
     * @throws \Exception
     */
    public function __requestWithTries(string $url, string $method, array $parameters = [], $tries = 3, $betweenTriesTime = 5, $specificValue = null)
    {
        // Check if given method is valid
        $this->isValidMethod($method);
        // Call external service
        do {
            try {
                // Try communicate with external service
                return $this->__request($url, $method, $parameters, $specificValue);
            } catch (\Exception $e) {
                $tries--;
                sleep($betweenTriesTime);
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
     * @param null $specificValue - Specific value that you want from response
     * @return array|string
     * @throws \Exception
     */
    public function __request(string $url, string $method, array $parameters = [], $specificValue = null)
    {
        return Http::{$method}($url, $parameters)->onError(function () {
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
