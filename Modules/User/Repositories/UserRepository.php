<?php

namespace Modules\User\Repositories;

use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\UserModel;
use Modules\User\Http\Requests\UserRequest;

class UserRepository
{

    protected $user;
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Store user data in database.
     * @return Renderable
     */

    public function userRegister(UserRequest $request)
    {
        try {
            $this->user->firstName = $request['firstName'];
            $this->user->lastName = $request['lastName'];
            $this->user->Role_id = $request['Role_id'];
            $this->user->DOB = $request['birthdayDate'];
            $this->user->emailID = $request['emailID'];
            $this->user->phoneNumber = $request['phoneNumber'];
            $this->user->password = Hash::make($request['password']);
            $save = $this->user->save();
            $this->user->roles()->attach($request['RoleID']);
            return true;
        } catch (Exception $th) {
            throw $th;
        }
    }
}
