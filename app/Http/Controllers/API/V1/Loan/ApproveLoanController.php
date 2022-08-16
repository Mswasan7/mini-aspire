<?php

namespace App\Http\Controllers\API\V1\Loan;

use App\Http\Actions\ApproveLoanAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Loan\ShowLoanData;
use App\Http\DataTransferObjects\Loan\ShowLoanMinimalData;
use App\Http\DataTransferObjects\ResponseData;
use App\Models\Loan;

class ApproveLoanController extends Controller
{


    public function update($id, ApproveLoanAction $action)
    {
        $authUser = loggedInUser();
        $loanStatus = getSystemSettings(config('global.system_settings.name.approved'));

        $loan = $action($id, $authUser, $loanStatus);

        $loan->load([
            'user',
            'approvedBy',
            'status'
        ]);
        return new ResponseData([
            'data' => new ShowLoanMinimalData($loan->toArray())
        ]);
    }

}
