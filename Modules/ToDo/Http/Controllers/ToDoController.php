<?php

namespace Modules\ToDo\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\ToDo\Entities\TasksModel;
use Modules\ToDo\Http\Requests\CreateRequest;
use Modules\User\Entities\UserModel;
use ToDoService;

class ToDoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function goToMyTasks()
    {
        if (Gate::denies('isDev')) {
            abort(403, 'You are not authorized');
        }
        $rows = UserModel::all();
        $data = UserModel::join('User_Tasks', 'User_data.id', '=', 'User_Tasks.User_id')
            ->join('Tasks', 'Tasks.Task_id', '=', 'User_Tasks.Task_id')
            ->select('User_data.*', 'Tasks.*')
            ->where('Assigned To', Auth::user()->id)
            ->get();
        return view('todo::myTasks', array('data' => $data, 'rows' => $rows));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function goToTasks()
    {
        if (Gate::denies('isManager')) {
            abort(403, 'You are not authorized');
        }
        if (session('userActive')) {
            $users = $rows = UserModel::join('user_role', 'User_data.id', '=', 'user_role.User_id')
                ->join('Role', 'Role.Role_id', '=', 'user_role.role_id')
                ->select('User_data.*', 'Role.*')
                ->get();
            $taskTable = UserModel::join('User_Tasks', 'User_data.id', '=', 'User_Tasks.User_id')
                ->join('Tasks', 'Tasks.Task_id', '=', 'User_Tasks.Task_id')
                ->select('User_data.*', 'Tasks.*')
                ->where('Assigned By', Auth::user()->id)
                ->get();

            return view('todo::tasks', array('taskTable' => $taskTable, 'users' => $users));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('todo::index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getTasks(CreateRequest $request)
    {
        try {
            ToDoService::createRegister($request);
            return redirect()->Route('tasksRoute');
        } catch (Exception $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function saveStatus(Request $req)
    {
        TasksModel::where('Task_id', $req->id)->update(['Status' => $req->status]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function updateTask(Request $req)
    {
        TasksModel::where('Task_id', $req->id)->update(['Title' => $req->title, 'Description' => $req->desc, 'Assigned To' => $req->assignedTo]);
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('todo::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('todo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('todo::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    // public function deleteTask(Request $req)
    // {
    //     TasksModel::where('Task_id',$req->id)->delete();
    //     return redirect()->route("tasksRoute");

    // }
    public function deleteTask(Request $req)
    {
        TasksModel::where('Task_id', $req->id)->delete();

    }
}
