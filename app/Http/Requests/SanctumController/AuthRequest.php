<?php

namespace App\Http\Requests\SanctumController;

use App\Http\Requests\BaseRequest;
use App\Http\Services\CharLength;

class AuthRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'min:' . CharLength::MIN_EMAIL,
                'max:' . CharLength::MAX_EMAIL,
            ],
            'password' => [
                'required',
                'min:' . CharLength::MIN_PASSWORD,
                'max:' . CharLength::MAX_PASSWORD,
            ],
            'device_name' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
        ];
    }
}
