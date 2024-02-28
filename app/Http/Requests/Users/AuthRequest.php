<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\LoginUserDto;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function toDTO(): LoginUserDto
    {
        return new LoginUserDto(
            $this->get('email'),
            $this->get('password'),
        );
    }
}
