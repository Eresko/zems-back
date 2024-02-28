<?php

namespace App\Http\Controllers\Tasks;


use Illuminate\Http\Request;
use App\Http\Requests\Tasks\TaskTimestampRequest;
use Illuminate\Support\Carbon;
use App\Services\TaskService;

class TaskTimestampController
{

    public function __construct(
        protected TaskService $taskService
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/api/task/timestamp",
     *     tags={"Задачи"},
     *     summary="Отметка времени",
     *     security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"task_id","watch"},
     *                 @OA\Property(
     *                      property="task_id",
     *                      type="integer",
     *                      description="id  задачи",
     *                      example=1,
     *                  ),
     *                @OA\Property(
     *                      property="watch",
     *                      type="integer",
     *                      description="Мремя потраченное на задачу",
     *                      example=2,
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
    public function create(TaskTimestampRequest $request)
    {

        return response()->json([
            'success' => $this->taskService->createTimestamp($request->toDto())
        ]);
    }

}
