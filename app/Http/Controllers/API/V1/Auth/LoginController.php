<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Actions\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\ResponseData;
use App\Http\DataTransferObjects\User\LoginInputData;
use App\Http\DataTransferObjects\User\LoginUserData;
use App\Http\DataTransferObjects\User\UserMinimalData;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $inputs = LoginInputData::fromRequest($request);

        $user = $loginAction($inputs);

        return new ResponseData([
            'data' => (new LoginUserData($user->toArray())),
        ]);

    }

}
