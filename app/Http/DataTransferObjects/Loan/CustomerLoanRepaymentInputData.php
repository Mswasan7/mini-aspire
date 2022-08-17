<?php
/**
 * Loan Repayment Input
 */

namespace App\Http\DataTransferObjects\Loan;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CustomerLoanRepaymentInputData extends DataTransferObject
{
     /**
     * @var int|float|null
     */
    public $amount_paid;

    public static function fromRequest(Request $request): CustomerLoanRepaymentInputData
    {
        return new self([
            'amount_paid' => $request->input('amount_paid')
        ]);
    }

    public static function fromArray($array): CustomerLoanRepaymentInputData
    {
        return new self([
            'amount_paid' => $array['amount_paid']
        ]);
    }
}
