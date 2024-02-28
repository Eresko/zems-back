<?php

namespace App\Repository;

use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Dto\CreateUserDto;
use App\Dto\LoginUserDto;
use Illuminate\Support\Facades\Hash;

class UserRepository
{


    /**
     * @param CreateUserDto $dto
     * @return bool
     */
    public function create(CreateUserDto $dto):bool {

        $user = User::create($dto->toArray());
        return (!empty($user));
    }

    /**
     * @param LoginUserDto $dto
     * @return string
     */
    public function login(LoginUserDto $dto):string {

        $user = User::where('email',$dto->email)->first();
        if (! $user || ! Hash::check($dto->password, $user->password)) {
            return Hash::check($dto->password, $user->password);
        }
        return $user->createToken($user->name)->plainTextToken;
    }

    /**
     * @param string $search
     * @return Collection
     */
    public function list(string $search):Collection {

        if (trim($search) == "") {
            return User::query()->get();
        }
        return User::query()->where("name",'LIKE','%'.$search.'%')->get();
    }

    public function changePassword(string $password):bool {

        $user = User::find(\Auth::user()->id);
        $user->password= Hash::make($password);
        return $user->save();
    }
}