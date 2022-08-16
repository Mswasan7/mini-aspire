<?php
/**
 * Show Minimal Loan Data
 */

namespace App\Http\DataTransferObjects\Loan;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class ShowLoanMinimalData extends GeneralFlexibleDataTransferObject
{
   /**
     * @var int|float|null
     */
    public $total_amount_requested;

    public ?int $term;

    /**
     * Classes with their FQCN:
     *
     * @var \App\Http\DataTransferObjects\User\UserMinimalData|null
     */
    public $approved_by;

    /**
     * Classes with their FQCN:
     *
     * @var \App\Http\DataTransferObjects\SystemConfig\SystemConfigMinimalData|null;
     */
    public $status;


    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
        $this->transitIdToGuid($parameters);
    }
}
