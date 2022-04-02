<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\UserRequest;
use UserService;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function form()
    {
        return view('user::form');
    }

    /**
     * Store user data in database via Services.
     * @return Renderable
     */

    public function store(UserRequest $request)
    {
        try {
            UserService::userRegister($request);
            return redirect()->route('login');
        } catch (Execption $th) {
            return $th;
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     *
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('user::edit');
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
    public function destroy($id)
    {
        //
    }

}
