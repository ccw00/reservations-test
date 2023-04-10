<?php

namespace Database\Factories;

use App\Http\Services\CharLength;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(CharLength::MAX_TITLE),
            'description' => fake()->text(CharLength::MAX_DESCRIPTION),
            'deadline' => fake()->dateTime,
            'location' => fake()->text(CharLength::MAX_LOCATION),
            'price' => fake()->numberBetween(CharLength::MIN_PRICE, CharLength::MAX_PRICE),
            'attendee_limit' => fake()->numberBetween(CharLength::MIN_ATTENDEE_LIMIT, CharLength::MAX_ATTENDEE_LIMIT),
            'user_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }

    public function withTitle(string $title): EventFactory
    {
        return $this->state(function (array $attributes) use ($title) {
            return [
                'title' => $title,
            ];
        });
    }

    public function withDescription(string $description): EventFactory
    {
        return $this->state(function (array $attributes) use ($description) {
            return [
                'title' => $description,
            ];
        });
    }

    public function withDeadline(string $deadline): EventFactory
    {
        return $this->state(function (array $attributes) use ($deadline) {
            return [
                'deadline' => $deadline,
            ];
        });
    }

    public function withAttendeeLimit(string $attendeeLimit): EventFactory
    {
        return $this->state(function (array $attributes) use ($attendeeLimit) {
            return [
                'attendee_limit' => $attendeeLimit,
            ];
        });
    }
}
