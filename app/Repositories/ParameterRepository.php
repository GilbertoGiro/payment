<?php

namespace App\Repositories;

use App\Models\Parameter;

class ParameterRepository extends AbstractRepository
{
    /**
     * ParameterRepository constructor.
     * @param Parameter $model
     */
    public function __construct(Parameter $model)
    {
        parent::__construct($model);
    }

    /**
     * Method to get parameter value by it name
     * @param string $parameter
     * @return string
     */
    public function getValue(string $parameter): string
    {
        // Find parameter object
        $parameterObject = $this->findBy(['name' => $parameter]);
        // If exists then retrieve it value
        return ($parameterObject) ? $parameterObject->value : '';
    }
}
