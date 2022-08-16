<?php
/** Approve Loan and store status history */

namespace App\Http\Actions;

use App\Models\Loan;
use App\Models\LoanStatusHistory;
use Illuminate\Support\Facades\DB;

class ApproveLoanAction
{
    /**
     * @param CreateLoanInputData $data
     * @param $authUser
     * @return mixed
     */
    public function __invoke($loanGuid, $authUser, $loanStatus): Loan
    {
        DB::beginTransaction();

        $loan = Loan::where('guid','=', $loanGuid)
            ->whereNull('approved_by')
            ->firstorFail();


        $loan->update([
            'approved_by' => $authUser->id,
            'status_id' => $loanStatus->id
        ]);


        LoanStatusHistory::create([
            'author_id' => $authUser->id,
            'objectable_id' => $loan->id,
            'objectable_type' => 'Loan Approved',
            'status' => $loanStatus->name,
            'system_notes' => 'Loan request approved successfully',
        ]);

        DB::commit();


        return $loan;


    }
}
