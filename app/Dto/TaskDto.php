<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class TaskDto
{
    public function __construct(
        public string $name,
        public string $description,
        public int    $projectId,
    ) {
    }

    public function toArray():array {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'project_id' => $this->projectId,

        ];
    }

}