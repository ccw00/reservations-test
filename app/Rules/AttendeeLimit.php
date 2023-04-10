<?php

namespace App\Rules;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AttendeeLimit implements ValidationRule
{
    public int $currentAttendees;

    public function __construct(Event $event)
    {
        $this->currentAttendees = $event->reservations()->count();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->currentAttendees >= $value) {
            $fail('Max attendee limit must be higher than current attendees number. Current attendees number is ' . $this->currentAttendees);
        }
    }
}
