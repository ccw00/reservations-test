<?php

namespace App\Http\Requests\RegisterController;

use App\Http\Requests\BaseRequest;
use App\Http\Services\CharLength;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:' . CharLength::MIN_NAME,
                'max:' . CharLength::MAX_NAME,
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                'min:' . CharLength::MIN_EMAIL,
                'max:' . CharLength::MAX_EMAIL,
            ],
            'password' => [
                'required',
                'max:' . CharLength::MAX_PASSWORD,
                Password::min(CharLength::MIN_PASSWORD)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }
}
