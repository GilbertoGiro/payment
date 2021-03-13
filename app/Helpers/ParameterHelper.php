<?php

namespace App\Helpers;

use App\Repositories\ParameterRepository;

class ParameterHelper
{
    /**
     * Method to get parameter value by it name
     * @param string $parameter
     * @return string
     */
    public static function getValue(string $parameter): string
    {
        // Find parameter object
        $parameterObject = app(ParameterRepository::class)->findBy(['name' => $parameter]);
        // If exists then retrieve it value
        return ($parameterObject) ? $parameterObject->value : '';
    }
}
