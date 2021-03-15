<?php

namespace App\Services\Api;

use App\Traits\Client;
use App\Models\Parameter;
use App\Repositories\ParameterRepository;

class ExternalAuthorizeService
{
    use Client;

    /**
     * Variable who specify when service is authorized
     * @var string
     */
    const AUTHORIZED = 'Autorizado';

    /**
     * Variable who contains parameter repository
     * @var ParameterRepository
     */
    protected $parameterRepository;

    /**
     * ExternalAuthorizeService constructor.
     * @param ParameterRepository $parameterRepository
     */
    public function __construct(ParameterRepository $parameterRepository)
    {
        $this->parameterRepository = $parameterRepository;
    }

    /**
     * Method to check if external service authorize action
     * @throws \Exception
     */
    public function authorize()
    {
        // Call external service to check if it authorize action
        $response = $this->__requestWithTries(
            $this->parameterRepository->getValue(Parameter::EXTERNAL_AUTHORIZER_URL),
            'get',
            [],
            3,
            5,
            30,
            'message'
        );
        // Check if is authorized
        if (!$response || $response !== $this::AUTHORIZED) {
            throw new \Exception('External authorization service did\'t authorize action', 401);
        }
    }
}
