<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Dto\TaskDto;
use Illuminate\Support\Facades\Hash;

class TaskRepository
{


    /**
     * @param TaskDto $dto
     * @return bool
     */
    public function create(TaskDto $dto):bool {

        $task = Task::create($dto->toArray());
        return (!empty($task));
    }

    /**
     * @param string $search
     * @param int $id
     * @return Collection
     */
    public function list(string $search,int $id):Collection {

        if (trim($search) == "") {
            return Task::query()->where('project_id',$id)->get();
        }
        return Task::query()->where('project_id',$id)->where("name",'LIKE','%'.$search.'%')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id) {

        return Task::query()->find($id);
    }

  



}