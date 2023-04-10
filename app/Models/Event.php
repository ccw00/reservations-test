<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Event extends Model
{
    use HasFactory;

    public const ROUTE_BINDING_ENTITY_NAME = 'event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'location',
        'price',
        'attendee_limit',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUser(): ?User
    {
        return $this->user()->get();
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'event_id');
    }

    public function getReservations(): Collection
    {
        return $this->reservations()->get();
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->findOrFail($value);
    }

    public function scopeApplyAttendeeLimit(Builder $query, bool $reached = false): Builder
    {
        return $query->where('attendee_limit', $reached ? '<=' : '>=', $this->reservations()->count());
    }

    public function scopeApplyDeadline(Builder $query, bool $reached = false): Builder
    {
        return $query->where('deadline', $reached ? '<=' : '>=', today());
    }
}
