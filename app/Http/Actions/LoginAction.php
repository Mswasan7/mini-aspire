<?php
/**
 * Action is used to login a user based on params
 */

namespace App\Http\Actions;


use App\Http\DataTransferObjects\User\LoginInputData;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginAction
{

    /**
     * @param LoginInputData $data
     * @param $userId
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     * @throws ValidationException
     */
    public function __invoke(LoginInputData $data, $userId = null)
    {
        $user = User::where('email', '=', $data->email)->first();

        if (!$user) {

             throw ValidationException::withMessages(['email' => "This email address does'nt exist"]);

        } else {
            if ($user->is_active == 0) {

                throw ValidationException::withMessages(['email' => "You are not an active user"]);
            }

            if (!Auth::attempt(['email' => $data->email, 'password' => $data->password])) {

                throw ValidationException::withMessages(['password' => "Please enter correct password"]);
            } else {

                $user = Auth::user();
                $user->token = $user->createToken('token')->plainTextToken;


                return $user;

            }
        }
    }

}
