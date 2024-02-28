<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class CreateUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public function toArray():array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,

        ];
    }

}