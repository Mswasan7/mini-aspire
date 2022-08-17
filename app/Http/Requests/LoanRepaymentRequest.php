<?php

namespace App\Http\Requests;

use App\Models\Loan;
use App\Models\LoanRepayment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class LoanRepaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'amount_paid' => ['required', 'numeric', 'min_payable_amount', 'max_payable_amount']
        ];
    }

    public function messages(): array
    {
        return [
            'amount_paid.min_payable_amount' => ['Please pay minimum loan repayment amount'],
            'amount_paid.max_payable_amount' => ['Please check, you have attempted more than remaining pending amount']
        ];
    }

    protected function getValidatorInstance(): \Illuminate\Contracts\Validation\Validator
    {
        $validator = parent::getValidatorInstance();

        $validator->addImplicitExtension(
            'min_payable_amount', fn($attribute, $value, $parameters) => !$this->getMinimumPayableAmount($attribute, $value, $parameters),
        );

        $validator->addImplicitExtension(
            'max_payable_amount', fn($attribute, $value, $parameters) => !$this->getMaximumPayableAmount($attribute, $value, $parameters),
        );

        return $validator;
    }

    public function getMinimumPayableAmount($attribute, $value, $parameters): bool
    {
        $loanRepayment = $this->getLatestLoanRepaymentDetails($attribute, $value, $parameters);

        if ($loanRepayment) {
            $pendingLoanRepaymentAmount = round($loanRepayment->total_payable_amount - $loanRepayment->total_paid_amount, 2);

            if ($pendingLoanRepaymentAmount > $value) {
                return true;
            }

        }
        return false;
    }

    public function getLatestLoanRepaymentDetails($attribute, $value, $parameters): LoanRepayment|null
    {
        $loan = $this->getLoanDetails($attribute, $value, $parameters);

        return $loan->loanRepayments->where('status_id', '=', getSystemSettings(config('global.system_settings.name.pending'))->id)
            ->first();
    }

    public function getLoanDetails($attribute, $value, $parameters): Loan
    {
        $loanGuid = $this->route()->parameter('id');

        return Loan::where('guid', '=', $loanGuid)
            ->where('user_id', '=', loggedInUser()->id)
            ->where('status_id', '=', getSystemSettings(config('global.system_settings.name.pending'))->id)
            ->firstorFail();
    }

    public function getMaximumPayableAmount($attribute, $value, $parameters): bool
    {
        $loan = $this->getLoanDetails($attribute, $value, $parameters);

        $totalPendingAmount = round($loan->total_amount_requested - $loan->total_amount_received, 2);

        if ($value > $totalPendingAmount) {
            return true;
        }
        return false;
    }

}
