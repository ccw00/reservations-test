<?php

namespace App\Http\Requests\EventController;

use App\Http\Requests\BaseRequest;

class IndexEventRequest extends BaseRequest
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
            'deadline' => [
                'nullable',
                'bool',
            ],
            'attendee_limit' => [
                'nullable',
                'bool',
            ],
        ];
    }
}
