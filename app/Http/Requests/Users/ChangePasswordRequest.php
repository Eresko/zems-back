<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\LoginUserDto;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
   
            'password' => 'required|string',
        ];
    }


}
