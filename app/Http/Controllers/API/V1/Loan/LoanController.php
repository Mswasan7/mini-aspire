<?php

namespace App\Http\Controllers\API\V1\Loan;

use App\Http\Actions\CreateLoanAction;
use App\Http\Actions\CreateLoanRepaymentAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Loan\CreateLoanInputData;
use App\Http\DataTransferObjects\Loan\ShowLoanData;
use App\Http\DataTransferObjects\ResponseData;
use App\Http\Requests\CreateLoanRequest;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{

    public function store(CreateLoanRequest $request, CreateLoanAction $action, CreateLoanRepaymentAction $createLoanRepaymentAction)
    {
        $inputs = CreateLoanInputData::fromRequest($request);
        $authUser = loggedInUser();
        $loanStatus = getSystemSettings(config('global.system_settings.name.pending'));

        $entity = $action($inputs, $authUser, $loanStatus);


        return new ResponseData([
            'data' => collect([
                'id' => $entity->guid,
            ]),
        ]);
    }

    public function show($id)
    {
        $authUser = loggedInUser();
        $loan = Loan::where('guid','=', $id)->first();
        $loan->when($loan->disclosure_flag == true, function ($loan) use ($authUser) {
                    $loan->where('user_id','=', $authUser->id);
                })
            ->firstorFail();


        $loan->load([
            'user',
            'approvedBy',
            'status',
            'loanRepayments',
            'loanRepayments.status'
        ]);

        return new ResponseData([
            'data' => new ShowLoanData($loan->toArray())
        ]);

    }
}
