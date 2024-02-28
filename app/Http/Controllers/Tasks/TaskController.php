<?php

namespace App\Http\Controllers\Tasks;


use Illuminate\Http\Request;
use App\Http\Requests\Tasks\TaskCreateRequest;
use Illuminate\Support\Carbon;
use App\Services\TaskService;

class TaskController {

    public function __construct(
        protected TaskService $taskService
    ) {
    }
    /**
     * @OA\Post(
     *     path="/api/task",
     *     tags={"Задачи"},
     *     summary="Cоздание задачи",
     *     security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"name","discription","project_id"},
     *                 @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Название задачи",
     *                      example="Задача 1",
     *                  ),
     *                @OA\Property(
     *                      property="description",
     *                      type="string",
     *                      description="Описание задачи",
     *                      example="Простая задача",
     *                  ),
     *                @OA\Property(
     *                      property="project_id",
     *                      type="integer",
     *                      description="id проекта",
     *                      example=1,
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
    public function create(TaskCreateRequest $request)
    {

        return response()->json([
            'success' => $this->taskService->create($request->toDto())
        ]);
    }



    /**
     * @OA\Get(
     *     path="/api/task/{id}",
     *     tags={"Задачи"},
     *     security={{"bearerAuth":{}}},
     *     summary="Получение списка задач",
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *      ),
     *     @OA\Parameter(
     *        name="page",
     *        in="query",
     *        @OA\Schema(
     *                type="integer"
     *            )
     *       ),
     *      @OA\Parameter(
     *        name="all",
     *        in="query",
     *        @OA\Schema(
     *                type="integer"
     *            )
     *       ),
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
     *                       @OA\Property(property="name", type="string"),
     *                       @OA\Property(property="discription", type="string"),
     *                       @OA\Property(property="project_id", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function list(Request $request,$id)
    {

        return response()->json([
            'result' => $this->taskService->list(empty($request->page) ? 1: intval($request->page), empty($request->search) ? "" : $request->search,intval($id))
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/task/get/{id}",
     *     tags={"Задача"},
     *     security={{"bearerAuth":{}}},
     *     summary="Получение определенной задачи",
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *      ),
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
     *                       @OA\Property(property="name", type="string"),
     *                       @OA\Property(property="discription", type="string"),
     *                       @OA\Property(property="project_id", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function getTask(Request $request,$id)
    {

        return response()->json([
            'result' => $this->taskService->get(intval($id))
        ]);
    }



}