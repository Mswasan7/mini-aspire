<?php
/**
 * Action is used to create loan repayments
 */

namespace App\Http\Actions;
use App\Http\DataTransferObjects\Loan\CreateLoanInputData;
use App\Models\LoanRepayment;
use App\Models\LoanStatusHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CreateLoanRepaymentAction
{
    /**
     * @param CreateLoanInputData $data
     * @param $authUser
     * @return mixed
     */
    public function __invoke($authUser, $loanStatus, $loan):LoanRepayment
    {
        DB::beginTransaction();

        $loanTerm = $loan->term;
        $payableAmount = round($loan->total_amount_requested / $loanTerm,2);


        for ($i = 1; $i <= $loanTerm; $i++) {
            $scheduledPaymentDate = Carbon::parse($loan->created_at)->addWeek($i);

            $entity = LoanRepayment::create([
                'guid' => guid(),
                'total_payable_amount' => $payableAmount,
                'scheduled_payment_date' => $scheduledPaymentDate,
                'status_id' => $loanStatus->id,
                'loan_id' => $loan->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);

        }



        LoanStatusHistory::create([
            'author_id' => $authUser->id,
            'objectable_id' => $entity->id,
            'objectable_type' => 'Loan Repayment',
            'status' => $loanStatus->name,
            'system_notes' => 'Loan repayment entries created successfully',
        ]);


        DB::commit();

        return $entity;
    }
}
