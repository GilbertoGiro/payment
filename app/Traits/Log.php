<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log AS LogFacade;

trait Log
{
    /**
     * Method to log error message
     * @param \Exception $e
     */
    public static function errorLog(\Exception $e)
    {
        LogFacade::error(sprintf('[%s] - %s in %s:%s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()));
    }
}
