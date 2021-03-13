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
}
