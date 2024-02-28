<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use App\Models\Project;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Dto\ProjectDto;
use Illuminate\Support\Facades\Hash;

class ProjectRepository
{


    /**
     * @param ProjectDro $dto
     * @return bool
     */
    public function create(ProjectDto $dto):bool {

        $user = Project::create($dto->toArray());
        return (!empty($user));
    }

    /**
     * @param string $search
     * @return mixed
     */
    public function list(string $search):Collection {

        if (trim($search) == "") {
            return Project::query()->get();
        }

        return Project::query()->where("name",'LIKE','%'.$search.'%')->get();
    }


    public function getAnalytics():Collection {
        $projects = Project::query()
            ->leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')
            ->leftJoin('task_trackers', 'task_trackers.task_id', '=','tasks.id')
            ->select([
                "projects.id AS id",
                "projects.name AS name",
                "task_trackers.watch AS watch",
                "task_trackers.user_id AS user_id",
            ])
            ->get()->groupBy('id');
        return  $projects;
    }

}