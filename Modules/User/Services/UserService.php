<?php

namespace Modules\User\Services;

use UserRepo;
use Exception;
use Modules\User\Http\Requests\UserRequest;

class UserService
{

    /**
     * Store user data in database via Repository.
     * @return
     */

    public function userRegister(UserRequest $request)
    {
        try {
            UserRepo::userRegister($request);
            return true;
        } catch (Exception $th) {
            throw $th;
        }
    }

}
