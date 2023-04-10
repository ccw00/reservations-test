<?php

namespace App\Http\Requests\EventController;

use App\Http\Requests\BaseRequest;
use App\Http\Services\CharLength;
use App\Models\Event;
use App\Rules\AttendeeLimit;

class UpdateEventRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        /** @var Event $event */
        $event = $this->route(Event::ROUTE_BINDING_ENTITY_NAME);

        return [
            'title' => [
                'string',
                'min:' . CharLength::MIN_TITLE,
                'max:' . CharLength::MAX_TITLE,
            ],
            'description' => [
                'string',
                'min:' . CharLength::MIN_DESCRIPTION,
                'max:' . CharLength::MAX_DESCRIPTION,
            ],
            'deadline' => [
                'date',
                'after:today',
            ],
            'location' => [
                'string',
                'min:' . CharLength::MIN_LOCATION,
                'max:' . CharLength::MAX_LOCATION,
            ],
            'price' => [
                'integer',
                'between:' . CharLength::MIN_PRICE . ',' . CharLength::MAX_PRICE,
            ],
            'attendee_limit' => [
                'integer',
                'between:' . CharLength::MIN_ATTENDEE_LIMIT . ',' . CharLength::MAX_ATTENDEE_LIMIT,
                new AttendeeLimit($event),
            ],
        ];
    }
}
