<?php

namespace App\Services;


use App\Repository\UserRepository;
use App\Dto\ClientDto;
use App\Dto\CreateUserDto;
use App\Dto\LoginUserDto;
use App\Dto\PaginationRequestDto;
class UserService
{

    public function __construct(
        private UserRepository $userRepository,
        private PaginationService $paginationService,
    )
    {
    }


    /**
     * @param ClientDto $dto
     * @return bool
     */
    public function create(CreateUserDto $dto):bool {
        return $this->userRepository->create($dto);
    }


    /**
     * @param LoginUserDto $dto
     * @return string
     */
    public function login(LoginUserDto $dto):string {
        return $this->userRepository->login($dto);
    }

    /**
     * @param int $page
     * @param string $search
     * @return PaginationRequestDto
     */
    public function list(int $page = 1,string $search = ""):PaginationRequestDto {
        $files = $this->userRepository->list($search);
        return $this->paginationService->toPagination($files,$page,5);
    }

    public function changePassword(string $password):bool {
        return $this->userRepository->changePassword($password);
    }

}