<?php

namespace App\Http\Requests\ReservationController;

use App\Http\Requests\BaseRequest;

class IndexReservationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'offset' => [
                'nullable',
                'integer',
            ],
            'limit' => [
                'nullable',
                'integer',
            ],
            'event_id' => [
                'nullable',
                'integer',
                'exists:events,id',
            ],
        ];
    }
}
