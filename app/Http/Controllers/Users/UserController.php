<?php

namespace App\Http\Controllers\Users;


use Illuminate\Http\Request;
use App\Http\Requests\Clients\CreateClientsRequest;
use App\Services\UserService;

class UserController {

    public function __construct(
        protected UserService $userService
    ) {
    }




    /**
     * @OA\Get(
     *     path="/api/user",
     *     tags={"Пользователи"},
     *     summary="Список пользователей",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *        name="page",
     *        in="query",
     *        @OA\Schema(
     *                type="integer"
     *            )
     *       ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         @OA\Schema(
     *                 type="string"
     *             )
     *        ),
     *     @OA\Response(
     *          response="200",
     *          description="",
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"result"},
     *                  @OA\Property(
     *                      property="result",
     *                      type="object",
     *                      required={"currentPage","perPage","total","lastPage","data"},
     *                    @OA\Property(
     *                       property="currentPage",
     *                       type="integer",
     *                   ),
     *                   @OA\Property(
     *                        property="perPage",
     *                        type="integer",
     *                    ),
     *                   @OA\Property(
     *                        property="total",
     *                        type="integer",
     *                    ),
     *                  @OA\Property(
     *                         property="lastPage",
     *                         type="integer",
     *                     ),
     *                    @OA\Property(
     *                        property="data",
     *                        type="array",
     *                      @OA\Items(
     *                       @OA\Property(property="id", type="integer"),
     *                       @OA\Property(property="name", type="string"),
     *                       @OA\Property(property="phone", type="string"),
     *                       @OA\Property(property="birthday", type="string"),
     *                       @OA\Property(property="created_at", type="string"),
     *                       @OA\Property(property="updated_at", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function getUsers(Request $request)
    {
       
        return response()->json([
            'result' => $this->userService->list(empty($request->page) ? 1: intval($request->page), empty($request->search) ? "" : $request->search)
        ]);
    }
    /**
     * @OA\Get(
     *     path="/api/user/check",
     *     tags={"Пользователи"},
     *     summary="проверка актыальности пользователя",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="",
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"result"},
     *                  ),
     *           ),
     *      )
     * )
     */

    public function check(Request $request)
    {

        return response()->json([
            'result' => \Auth::user()->id
        ]);
    }



}