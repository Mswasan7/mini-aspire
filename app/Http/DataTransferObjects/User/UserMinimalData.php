<?php
/** Return User Minimal Data*/

namespace App\Http\DataTransferObjects\User;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class UserMinimalData extends GeneralFlexibleDataTransferObject
{
    /** string|int */
    public $id;

    public ?string $first_name;

    public ?string $last_name;

    public ?string $email;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

    }

}
