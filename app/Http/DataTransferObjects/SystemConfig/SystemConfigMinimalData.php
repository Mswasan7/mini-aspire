<?php
/**
 *  Return Minimal Data of System Config
 */
namespace App\Http\DataTransferObjects\SystemConfig;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class SystemConfigMinimalData extends GeneralFlexibleDataTransferObject
{
    /** string|int */
    public $id;

    public ?string $name;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
    }
}
