<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventController\DestroyEventRequest;
use App\Http\Requests\EventController\IndexEventRequest;
use App\Http\Requests\EventController\StoreEventRequest;
use App\Http\Requests\EventController\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function index(IndexEventRequest $request)
    {
        $validatedData = $request->validated();

        $query = Event::query()->with('user')
            ->applyAttendeeLimit(Arr::get($validatedData, 'attendee_limit', false))
            ->applyDeadline(Arr::get($validatedData, 'deadline', false));

        return response()->paginate($query, EventResource::class, $request);
    }

    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;

        try {
            DB::beginTransaction();

            /** @var Event $newUser */
            $newEvent = Event::query()->create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->getOne(EventResource::make($newEvent), Response::HTTP_CREATED);
    }

    public function update(UpdateEventRequest $request)
    {
        /** @var Event $event */
        $event = $request->route(Event::ROUTE_BINDING_ENTITY_NAME);

        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $event->fill($validatedData)->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->getOne(EventResource::make($event));
    }

    public function destroy(DestroyEventRequest $request)
    {
        /** @var Event $event */
        $event = $request->route(Event::ROUTE_BINDING_ENTITY_NAME);

        try {
            DB::beginTransaction();

            $event->reservations()->delete();
            $event->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->success('Successfully deleted.');
    }
}
