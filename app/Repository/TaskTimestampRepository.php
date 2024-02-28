<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use App\Models\TaskTracker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Dto\TaskDto;
use Illuminate\Support\Facades\Hash;
use App\Dto\TaskTimestampDto;
class TaskTimestampRepository
{


    /**
     * @param TaskTimestampDto $dto
     * @return bool
     */
    public function create(TaskTimestampDto $dto):bool {

        $task = TaskTracker::create($dto->toArray());
        return (!empty($task));
    }


}