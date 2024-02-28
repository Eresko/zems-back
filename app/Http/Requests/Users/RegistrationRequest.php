<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\CreateUserDto;
use Illuminate\Support\Facades\Hash;

class RegistrationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:Users,email',
            'password' => 'required|string',
        ];
    }

    public function toDTO(): CreateUserDto
    {
        return new CreateUserDto(
            $this->get('name'),
            $this->get('email'),
            Hash::make($this->get('password'))
        );
    }
}
