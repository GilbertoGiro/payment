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
    const PUBLISHED = 'Enviado';

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
            30,
            'message'
        );
        // Check if message was published
        if (!$response || $response !== $this::PUBLISHED) {
            throw new \Exception('Could not publish message on external notification service', 500);
        }
    }
}
