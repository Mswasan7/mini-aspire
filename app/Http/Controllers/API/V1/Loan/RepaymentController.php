<?php

namespace App\Http\Controllers\API\V1\Loan;

use App\Http\Actions\CustomerLoanRepaymentAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Loan\CustomerLoanRepaymentInputData;
use App\Http\DataTransferObjects\Loan\ShowLoanMinimalData;
use App\Http\DataTransferObjects\ResponseData;
use App\Http\Requests\LoanRepaymentRequest;
use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Support\Facades\Log;

class RepaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:customer']);
    }
    public function update($id, LoanRepaymentRequest $request)
    {
        $authUser = loggedInUser();
        $inputs = CustomerLoanRepaymentInputData::fromRequest($request);

        $loan = CustomerLoanRepaymentAction::dispatch($inputs, $authUser, $id);

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
