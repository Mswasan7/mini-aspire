<?php
/** Approve Loan and store status history */

namespace App\Http\Actions;

use App\Http\DataTransferObjects\Loan\CustomerLoanRepaymentInputData;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\LoanStatusHistory;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CustomerLoanRepaymentAction
{
    use Dispatchable;

    public $loan;
    public $amount_paid;
    public $auth_user;
    public $id;
    public $loan_repayments;
    public $pending_status;
    public $paid_status;
    public $loan_repayments_count;

    public function __construct(CustomerLoanRepaymentInputData $inputData, $authUser, $id)
    {
        $this->amount_paid = $inputData->amount_paid;
        $this->auth_user = $authUser;
        $this->id = $id;
        $this->pending_status = getSystemSettings(config('global.system_settings.name.pending'));
        $this->paid_status = getSystemSettings(config('global.system_settings.name.paid'));
    }

    /* Get Loan Object */
    /**
     * @return $this
     * @throws ValidationException
     */
    public function getLoan()
    {
        $this->loan = Loan::with(['loanRepayments'])
            ->where('guid', '=', $this->id)
            ->where('user_id', '=', $this->auth_user->id)
            ->where('status_id', '=', $this->pending_status->id)
            ->whereNotNull('approved_by')
            ->first();

        if(!$this->loan)
        {
            throw ValidationException::withMessages(['loan' => "Please enter valid loan details"]);
        }
        return $this;
    }

    /* Get Loan Repayment Object */
    public function getLoanRepayments()
    {
        $this->loan_repayments = $this->loan->loanRepayments->where('status_id','=', $this->pending_status->id);
        return $this;
    }

    /* Get Pending Loan Repayment Count  */
    public function getLoanRepaymentsCount()
    {
        $this->loan_repayments_count = $this->loan_repayments->count();
        return $this;
    }

    /* Store Loan Repayment */
    public function storeLoanRepayment()
    {
        if($this->loan_repayments_count > 0)
        {

            foreach($this->loan_repayments as $loan_repayment)
            {
                if($this->amount_paid != 0)
                {
                    $payableAmount = $loan_repayment->total_payable_amount - $loan_repayment->total_paid_amount;
                    if($this->amount_paid >= $payableAmount)
                    {
                        $loan_repayment->update([
                            'total_paid_amount' => $payableAmount,
                            'status_id'         => $this->paid_status->id,
                            'updated_at'        => new \DateTime()
                            ]);
                    }

                    if($this->amount_paid < $payableAmount)
                    {
                        $loan_repayment->update([
                            'total_paid_amount' => $this->amount_paid,
                        ]);
                    }

                    $this->amount_paid= $this->amount_paid - $payableAmount;
                }
            }
        }

        return $this;
    }

    /* Update Loan Status */
    public function updateLoanStatus()
    {
        if($this->loan_repayments_count == 0)
        {
            $this->loan->update(['status_id' => $this->paid_status->id, 'updated_at' => new \DateTime()]);
        }
        return $this;
    }

    /**
     * Final Output
     */
    public function get() : object
    {
        return $this->loan;
    }


    /**
     * @return mixed
     */
    public function handle()
    {
        return DB::transaction(function () {
            return $this->getLoan()
                ->getLoanRepayments()
                ->getLoanRepaymentsCount()
                ->storeLoanRepayment()
                ->updateLoanStatus()
                ->get();
        });




/*        LoanStatusHistory::create([
            'author_id' => $authUser->id,
            'objectable_id' => $entity->id,
            'objectable_type' => 'Loan Repayment',
            'status' => $loanStatus->name,
            'system_notes' => 'Loan repayment entries created successfully',
        ]);*/


    }
}
