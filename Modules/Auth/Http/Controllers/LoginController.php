<?php

namespace Modules\Auth\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\User\Entities\UserModel;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function store(LoginRequest $request)
    {
        try {
            $email = $request->emailID;
            $password = $request->password;
            if (Auth::attempt(['emailID' => $email, 'password' => $password])) {
                Session()->put('userActive', 1);
                return redirect()->route('welcomeRoute');
            }
            return redirect()->route('login');
        } catch (Exception $th) {
            throw $th;
        }
    }

    /**
     * Show Login Page
     * @return Renderable
     */

    public function index()
    {
        if (session('userActive')) {
            return redirect()->route('welcomeRoute');
        } else {
            return view('auth::LoginPage');
        }

    }

    /**
     * Logout from session
     * @return Renderable
     */
    public function logout()
    {
        session()->forget('userActive');
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        if (session('userActive')) {
            return view('auth::LoginWelcome');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function showAdmin()
    {
        if (Gate::denies('isAdmin')) {
            abort(403, 'You are not authorized');
        }
        if (session('userActive')) {

            $rows = UserModel::join('user_role', 'User_data.id', '=', 'user_role.User_id')
                ->join('Role', 'Role.Role_id', '=', 'user_role.role_id')
                ->select('User_data.*', 'Role.*')
                ->get();
            return view('auth::adminList', array('rows' => $rows));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function showManager()
    {
        if (Gate::allows('isDev')) {
            abort(403, 'You are not authorized');
        }
        if (session('userActive')) {
            $rows = UserModel::join('user_role', 'User_data.id', '=', 'user_role.User_id')
                ->join('Role', 'Role.Role_id', '=', 'user_role.role_id')
                ->select('User_data.*', 'Role.*')
                ->get();
            return view('auth::managerList', array('rows' => $rows));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the specified resource.
     * @return Renderable
     */
    public function showDev()
    {
        if (session('userActive')) {
            $rows = UserModel::join('user_role', 'User_data.id', '=', 'user_role.User_id')
                ->join('Role', 'Role.Role_id', '=', 'user_role.role_id')
                ->select('User_data.*', 'Role.*')
                ->get();
            return view('auth::devList', array('rows' => $rows));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $row = UserModel::find($id);
        $row->status = !$row->status;

        $row->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function actionPermission(Request $request, $id)
    {
        if($request->checkbox == 1){
            UserModel::where('id',$id)->update(['actionPermission'=>1]);
        }else{
            UserModel::where('id',$id)->update(['actionPermission'=>0]);
        }
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
