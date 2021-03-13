<?php

namespace App\Services\Api;

use App\Traits\Client;
use App\Models\Parameter;
use App\Helpers\ParameterHelper;

class ExternalAuthorizeService
{
    use Client;

    /**
     * Variable who specify when service is authorized
     * @var string
     */
    const AUTHORIZED = 'Autorizado';

    /**
     * Method to check if external service authorize action
     * @throws \Exception
     */
    public function authorize()
    {
        // Call external service to check if it authorize action
        $response = $this->__requestWithTries(
            ParameterHelper::getValue(Parameter::EXTERNAL_AUTHORIZER_URL),
            'get',
            [],
            3,
            5,
            'message'
        );
        // Check if is authorized
        if ($response !== $this::AUTHORIZED) {
            throw new \Exception('403', 'External service did\'t authorize action');
        }
    }
}
