<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class LoginUserDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    public function toArray():array {
        return [
            'email' => $this->email,
            'password,' => $this->password,

        ];
    }

}