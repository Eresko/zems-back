<?php

namespace App\Services;


use App\Dto\PaginationRequestDto;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use App\Dto\ProjectDto;
use Illuminate\Support\Collection;
class ProjectService
{

    public function __construct(
        private ProjectRepository $projectRepository,
        private PaginationService $paginationService,
        private UserRepository $userRepository,
    )
    {
    }


    /**
     * @param ClientDto $dto
     * @return bool
     */
    public function create(ProjectDto $dto):bool {
        return $this->projectRepository->create($dto);
    }


    /**
     * @param int $page
     * @param string $search
     * @return PaginationRequestDto
     */
    public function list(int $page = 1,string $search = ""):PaginationRequestDto {
        $files = $this->projectRepository->list($search);
        return $this->paginationService->toPagination($files,$page,5);
    }

    /**
     * @param int $page
     * @param string $search
     * @return PaginationRequestDto
     */
    public function getAnalytics(int $page = 1,string $search = ""):PaginationRequestDto {

        $colors = ['0' => "#295495",1 => '#d995ea',2 => '#c57f3d',3=> '#299133',4=> '#999133', 5=> '#791133'];
        $users = $this->userRepository->list("")->toArray();
        $projects = $this->projectRepository->getAnalytics();
        $resultProject = [];
        foreach ($projects as $project) {
            $resPrp = [];
            foreach ($users as $key => $user) {
                $resPrp[]  = [
                    'count' => $project->where('user_id',$user['id'])->sum('watch'),
                    'name' => $user['name'],
                    'color' => $colors[$key]
                ];
            }
            $resultProject[] =[
                'watch_sum' => $project->sum('watch'),
                'id' =>$project->first()->id,
                'name' => $project->first()->name,
                'user_watch' => $resPrp
                ];
        }
        return $this->paginationService->toPagination(collect($resultProject),$page,4);
    }


  

}