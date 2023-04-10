<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public const ROUTE_BINDING_ENTITY_NAME = 'reservation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->findOrFail($value);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUser(): ?User
    {
        /** @var User $user */
        $user = $this->user()->first();

        return $user;
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function getEvent(): ?Event
    {
        /** @var Event $event */
        $event = $this->event()->first();

        return $event;
    }

    public function scopeApplyEvent(Builder $query, string $eventId): Builder
    {
        return $query->where('event_id', $eventId);
    }
}
