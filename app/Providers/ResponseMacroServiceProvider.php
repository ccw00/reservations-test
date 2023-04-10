<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response as ResponseFacade;
use Symfony\Component\HttpFoundation\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ResponseFacade::macro('failed', function (string $message = null, int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR) {
            return ResponseFacade::json([
                'error' => $message ?: __('response.general_fail'),
            ], $httpCode);
        });

        ResponseFacade::macro('success', function (array|string $value, int $httpCode = Response::HTTP_OK) {
            $message = is_array($value) ? $value : ['message' => $value];

            return ResponseFacade::json($message, $httpCode);
        });

        ResponseFacade::macro('getOne', function (JsonResource $resource, int $httpCode = Response::HTTP_OK) {
            return ResponseFacade::json($resource, $httpCode);
        });

        ResponseFacade::macro('paginate', function (Builder $query, string $resourceName, Request $request) {
            $count = (clone $query)->count();
            $data = $query->offset($request->route('offset', 0))->limit($request->route('limit', 15))->get();

            return ResponseFacade::json([
                'total' => $count,
                'data' => $resourceName::collection($data),
            ]);
        });
    }
}
