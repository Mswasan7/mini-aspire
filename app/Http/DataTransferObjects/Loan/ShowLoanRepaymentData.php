<?php
/**  Result Loan Repayment Data */

namespace App\Http\DataTransferObjects\Loan;

use App\Http\DataTransferObjects\GeneralFlexibleDataTransferObject;

class ShowLoanRepaymentData extends GeneralFlexibleDataTransferObject
{

    /**
     * @var int|float|null
     */
    public $total_payable_amount;

    /**
     * @var int|float|null
     */
    public $total_paid_amount;

    /** \Carbon\Carbon|null */
    public $created_at;
    public $scheduled_payment_date;

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
