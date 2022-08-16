<?php
/**  Result Loan Data */

namespace App\Http\DataTransferObjects\Loan;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class ShowLoanData extends GeneralFlexibleDataTransferObject
{

    /**
     * @var int|float|null
     */
    public $total_amount_requested;

    public ?int $term;

    /**
     * @var int|bool|null
     */
    public $disclosure_flag;

    /**
     * Classes with their FQCN:
     *
     * @var \App\Http\DataTransferObjects\User\UserMinimalData|null
     */
    public $user;

    /** \Carbon\Carbon|null */
    public $created_at;

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


    /**
     * Classes with their FQCN:
     *
     * @var \App\Http\DataTransferObjects\Loan\ShowLoanRepaymentData[]|null;
     */
    public $loan_repayments;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
        $this->transitIdToGuid($parameters);
    }
}
