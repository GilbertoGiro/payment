<?php

namespace App\Services\Api;

use App\Models\Parameter;
use App\Repositories\ParameterRepository;
use App\Traits\Client;

class ExternalNotificationService
{
    use Client;

    /**
     * Variable who specify when service is authorized
     * @var string
     */
    const AUTHORIZED = 'Enviado';

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
     * Method to publish notification on external service
     * @throws \Exception
     */
    public function notify()
    {
        // Call external service to check if it authorize action
        $response = $this->__requestWithTries(
            $this->parameterRepository->getValue(Parameter::EXTERNAL_NOTIFICATION_URL),
            'post',
            [],
            3,
            5,
            'message'
        );
        // Check if is authorized
        if ($response !== $this::AUTHORIZED) {
            throw new \Exception('External service did\'t authorize action', 500);
        }
    }
}
