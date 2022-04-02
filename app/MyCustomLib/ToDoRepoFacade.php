<?php

namespace App\MyCustomLib;

use Illuminate\Support\Facades\Facade;

class ToDoRepoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'toDoRepository';
    }
}