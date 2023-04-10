<?php

namespace App\Http\Requests\EventController;

use App\Http\Requests\BaseRequest;
use App\Http\Services\CharLength;

class StoreEventRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:' . CharLength::MIN_TITLE,
                'max:' . CharLength::MAX_TITLE,
            ],
            'description' => [
                'required',
                'string',
                'min:' . CharLength::MIN_DESCRIPTION,
                'max:' . CharLength::MAX_DESCRIPTION,
            ],
            'deadline' => [
                'required',
                'date',
                'after:today',
            ],
            'location' => [
                'required',
                'string',
                'min:' . CharLength::MIN_LOCATION,
                'max:' . CharLength::MAX_LOCATION,
            ],
            'price' => [
                'required',
                'integer',
                'between:' . CharLength::MIN_PRICE . ',' . CharLength::MAX_PRICE,
            ],
            'attendee_limit' => [
                'required',
                'integer',
                'between:' . CharLength::MIN_ATTENDEE_LIMIT . ',' . CharLength::MAX_ATTENDEE_LIMIT,
            ],
        ];
    }
}
