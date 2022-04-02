<?php

namespace App\MyCustomLib;

use Illuminate\Support\Facades\Facade;

class UserRepoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userRepository';
    }
}