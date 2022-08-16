<?php
/**
 * Create Loan Input Data
 */

namespace App\Http\DataTransferObjects\Loan;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CreateLoanInputData extends DataTransferObject
{

     /**
     * @var int|float|null
     */
    public $total_amount_request;

    public int $term;

    public ?bool $disclosure_flag;

    public static function fromRequest(Request $request): CreateLoanInputData
    {
        return new self([
            'total_amount_request' => $request->input('total_amount_request'),
            'term' => $request->input('term'),
            'disclosure_flag' => $request->input('disclosure_flag', false),
        ]);
    }

    public static function fromArray($array): CreateLoanInputData
    {
        return new self([
            'total_amount_request' => $array['total_amount_request'],
            'term' => $array['term'],
            'disclosure_flag' => $array['disclosure_flag'],
        ]);
    }
}
