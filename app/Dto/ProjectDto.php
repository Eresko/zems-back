<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class ProjectDto
{
    public function __construct(
        public string $name,
        public string $description,
        public int    $userId,
    ) {
    }

    public function toArray():array {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => $this->userId,

        ];
    }

}