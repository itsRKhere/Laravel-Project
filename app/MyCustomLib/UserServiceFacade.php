<?php

namespace App\MyCustomLib;

use Illuminate\Support\Facades\Facade;

class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userService';
    }
}