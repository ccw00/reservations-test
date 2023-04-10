<?php

namespace App\Http\Controllers;

use App\Http\Requests\SanctumController\AuthRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class SanctumController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::query()->where('email', Arr::get($validatedData, 'email'))->first();

        if (! $user || ! Hash::check(Arr::get($validatedData, 'password'), $user->password)) {
            return response()->failed('The provided credentials are incorrect.', 401);
        }

        return response()->success(['token' => $user->createToken(Arr::get($validatedData, 'device_name'))->plainTextToken]);
    }
}
