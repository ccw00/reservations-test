<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterController\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make(Arr::get($validatedData, 'password'));

        try {
            DB::beginTransaction();

            /** @var User $newUser */
            $newUser = User::query()->create($validatedData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->failed();
        }

        return response()->success(['token' => $newUser->createToken('NEW USER')->plainTextToken]);
    }
}
