<?php
/**
 * Login Input Data
 */
namespace App\Http\DataTransferObjects\User;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class LoginInputData extends DataTransferObject
{
    public string $email;

    public string $password;

    public ?bool $remember_me;

    public static function fromRequest(Request $request)
    : LoginInputData
    {
        return new self([
            'email'       => $request->input('email'),
            'password'    => $request->input('password'),
            'remember_me' => $request->input('remember_me', false),
        ]);
    }

    public static function fromArray($array)
    : LoginInputData
    {
        return new self([
            'email'       => $array['email'],
            'password'    => $array['password'],
            'remember_me' => $array['remember_me'],
        ]);
    }
}
