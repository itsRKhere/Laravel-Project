<?php

namespace Modules\ToDo\Services;

use ToDoRepo;
use Exception;
use Modules\ToDo\Http\Requests\CreateRequest;

class ToDoService
{

    /**
     * Store user data in database via Repository.
     * @return
     */

    public function createRegister(CreateRequest $request)
    {
        try {
            ToDoRepo::createRegister($request);
            return true;
        } catch (Exception $th) {
            throw $th;
        }
    }

}