<?php
/** Login Response Data
 */

namespace App\Http\DataTransferObjects\User;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class LoginUserData extends GeneralFlexibleDataTransferObject
{

    /** string|int */
    public $id;

    public ?string $first_name;

    public ?string $last_name;

    public ?string $email;

    public ?string $token;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

    }

}
