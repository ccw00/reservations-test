<?php

namespace App\Http\Requests\ReservationController;

use App\Http\Requests\BaseRequest;

class StoreReservationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'event_id' => [
                'nullable',
                'integer',
                'exists:events,id',
            ],
        ];
    }
}
