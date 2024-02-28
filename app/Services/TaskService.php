<?php

namespace App\Services;


use App\Dto\PaginationRequestDto;
use App\Repository\TaskRepository;
use App\Repository\TaskTimestampRepository;
use App\Dto\TaskDto;
use App\Dto\TaskTimestampDto;

class TaskService
{

    public function __construct(
        private TaskRepository $taskRepository,
        private PaginationService $paginationService,
        private TaskTimestampRepository $taskTimestampRepository,
    )
    {
    }


    /**
     * @param TaskDto $dto
     * @return bool
     */
    public function create(TaskDto $dto):bool {
        return $this->taskRepository->create($dto);
    }


    /**
     * @param int $page
     * @param string $search
     * @return PaginationRequestDto
     */
    public function list(int $page = 1,string $search = "",int $id):PaginationRequestDto {
        $files = $this->taskRepository->list($search,$id);
        return $this->paginationService->toPagination($files,$page,5);
    }

    public function createTimestamp(TaskTimestampDto $dto) {
        return $this->taskTimestampRepository->create($dto);
    }

    public function get($id) {
        return $this->taskRepository->get($id);
    }

}