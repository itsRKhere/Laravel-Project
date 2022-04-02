<?php

namespace Modules\ToDo\Repositories;

use Auth;
use Modules\ToDo\Entities\TasksModel;
use Modules\ToDo\Http\Requests\CreateRequest;

class ToDoRepository
{
    /**
     * Store user data in database.
     * @return Renderable
     */

    public function createRegister(CreateRequest $request)
    {
        $task = new TasksModel;
        try {
            $task->Title = $request['title'];
            $task->Description = $request['desc'];
            $task['Assigned To'] = $request->assignedTo;
            $task['Assigned By'] = Auth::user()->id;

            $task->save();

            $task->users()->attach($request->assignedTo);
            return true;
        } catch (Exception $th) {
            throw $th;
        }
    }

}
