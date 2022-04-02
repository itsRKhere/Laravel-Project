<?php

namespace App\MyCustomLib;

use Illuminate\Support\Facades\Facade;

class ToDoServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'toDoService';
    }
}