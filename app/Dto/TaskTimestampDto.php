<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Support\Collection;
class TaskTimestampDto
{
    public function __construct(
        public int $taskId,
        public int $watch,
        public int $userId,
    ) {
    }

    public function toArray():array {
        return [
            'task_id' => $this->taskId,
            'watch' => $this->watch,
            'user_id' => $this->userId,

        ];
    }

}