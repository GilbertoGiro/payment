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
        LogFacade::error("[{$e->getCode()}] {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}");
    }
}
