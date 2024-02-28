<?php

namespace App\Http\Controllers\Users;


use Illuminate\Http\Request;
use App\Http\Requests\Users\RegistrationRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\AuthRequest;
use App\Services\UserService;

class AuthController {

    public function __construct(
        protected UserService $service
    ) {
    }

    /**
     * @OA\Post(
     *     path="/api/user/registration",
     *     tags={"Пользователи"},
     *     summary="Регистрация",
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"name","email","password"},
     *                 @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Имя",
     *                      example="СЕргей",
     *                  ),
     *                @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="email",
     *                      example="shadow@mail.ru",
     *                  ),
     *              @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Пароль",
     *                      example="123123",
     *                  ),
     *           )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Упешная отправка",
     *         @OA\JsonContent(
     *                 type="object",
     *                 required={"success","result"},
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                 ),
     *          ),
     *     )
     * )
     */

    

    public function registration(RegistrationRequest $request)
    {

        return response()->json([
            'result' => $this->service->create($request->toDTO())
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     tags={"Пользователи"},
     *     summary="Авторизация",
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"email","password"},
     *                @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="email",
     *                      example="shadow@mail.ru",
     *                  ),
     *              @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Пароль",
     *                      example="123123",
     *                  ),
     *           )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Упешная отправка",
     *         @OA\JsonContent(
     *                 type="object",
     *                 required={"success","result"},
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                 ),
     *          ),
     *     )
     * )
     */



    public function login(AuthRequest $request)
    {

        return response()->json([
            'result' => $this->service->login($request->toDTO())
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/user/change-password",
     *     tags={"Пользователи"},
     *     summary="Изменение пароля",
     *    security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"password"},
     *              @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="Пароль",
     *                      example="123123",
     *                  ),
     *           )
     *      ),
     *     @OA\Response(
     *         response="200",
     *         description="Упешная отправка",
     *         @OA\JsonContent(
     *                 type="object",
     *                 required={"success","result"},
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                 ),
     *          ),
     *     )
     * )
     */



    public function changePassword(ChangePasswordRequest $request)
    {

        return response()->json([
            'result' => $this->service->changePassword($request->password)
        ]);
    }



}