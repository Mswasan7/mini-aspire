<?php
/** Used to send response json data */
namespace App\Http\DataTransferObjects;

use Illuminate\Contracts\Support\Responsable;
use Spatie\DataTransferObject\DataTransferObject;

class ResponseData extends DataTransferObject implements Responsable
{
    /** @var \Spatie\DataTransferObject\DataTransferObject|\Spatie\DataTransferObject\DataTransferObjectCollection|array */
    public $data;

    public function __construct(array $parameters = [], $status = 200)
    {
        parent::__construct($parameters);

        $this->status = $status;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return response()->json(
            [
                'data' => $this->data->toArray(),
            ],
            $this->status
        );
    }
}
