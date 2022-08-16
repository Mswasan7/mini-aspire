<?php
/**
 * Action is used to create a loan request
 */

namespace App\Http\Actions;

use App\Http\DataTransferObjects\Loan\CreateLoanInputData;
use App\Models\Loan;
use App\Models\LoanStatusHistory;
use Illuminate\Support\Facades\DB;

class CreateLoanAction
{
    /**
     * @param CreateLoanInputData $data
     * @param $authUser
     * @return mixed
     */
    public function __invoke(CreateLoanInputData $data, $authUser, $loanStatus): Loan
    {
        DB::beginTransaction();

        $entity = Loan::create([
            'guid' => guid(),
            'total_amount_requested' => $data->total_amount_request,
            'term' => $data->term,
            'disclosure_flag' => $data->disclosure_flag,
            'status_id' => $loanStatus->id,
            'user_id' => $authUser->id,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        LoanStatusHistory::create([
            'author_id' => $authUser->id,
            'objectable_id' => $entity->id,
            'objectable_type' => 'Loan Request',
            'status' => $loanStatus->name,
            'system_notes' => 'Loan request created successfully',
        ]);

        DB::commit();

        $createLoanRepaymentAction = new CreateLoanRepaymentAction();
        $createLoanRepaymentAction($authUser, $loanStatus, $entity);
        return $entity;


    }
}
