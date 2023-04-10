<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationController\DestroyReservationRequest;
use App\Http\Requests\ReservationController\IndexReservationRequest;
use App\Http\Requests\ReservationController\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Http\Services\QueryScopedAdditional;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function index(IndexReservationRequest $request)
    {
        $scopes = [
            'event_id' => 'applyEvent',
        ];

        $query = Reservation::query()->with(['user', 'event']);

        $query = QueryScopedAdditional::getConditionedQuery($scopes, $request, Reservation::class, $query);

        return response()->paginate($query, ReservationResource::class, $request);
    }

    public function store(StoreReservationRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;

        try {
            DB::beginTransaction();

            /** @var Reservation $newReservation */
            $newReservation = Reservation::query()->create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->getOne(ReservationResource::make($newReservation), Response::HTTP_CREATED);
    }

    public function destroy(DestroyReservationRequest $request)
    {
        /** @var Reservation $reservation */
        $reservation = $request->route(Reservation::ROUTE_BINDING_ENTITY_NAME);

        try {
            DB::beginTransaction();

            $reservation->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->success('Successfully deleted.');
    }
}
