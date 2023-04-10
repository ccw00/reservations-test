<?php

namespace App\Http\Services;

use App\Http\Requests\BaseRequest;
use Illuminate\Database\Eloquent\Builder;

class QueryScopedAdditional
{
    public static function getConditionedQuery(array $scopes, BaseRequest $request, string $modelClassName, Builder $query): Builder
    {
        foreach ($scopes as $requestKey => $scopeName) {
            if (
                $request->filled($requestKey) &&
                method_exists($modelClassName, 'scope' . ucfirst($scopeName))
            ) {
                $query->{$scopeName}($request->input($requestKey));
            }
        }

        return $query;
    }
}
