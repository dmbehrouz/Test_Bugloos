<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;

class LogsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'log_service';
    }
}
