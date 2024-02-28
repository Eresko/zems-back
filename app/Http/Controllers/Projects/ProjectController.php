<?php

namespace App\Http\Controllers\Projects;


use Illuminate\Http\Request;
use App\Http\Requests\Project\ProjectRequest;
use Illuminate\Support\Carbon;
use App\Services\ProjectService;

class ProjectController {

    public function __construct(
        protected ProjectService $projectService
    ) {
    }
    /**
     * @OA\Post(
     *     path="/api/project",
     *     tags={"Проекты"},
     *     summary="создвание проекта",
     *     security={{"bearerAuth":{}}},
     *    @OA\RequestBody(
     *          @OA\JsonContent(
     *                  type="object",
     *                  required={"name","discription"},
     *                 @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Название проекта",
     *                      example="Первый проект",
     *                  ),
     *                @OA\Property(
     *                      property="description",
     *                      type="string",
     *                      description="Описание проекта",
     *                      example="Простой проект",
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
    public function create(ProjectRequest $request)
    {

        return response()->json([
            'success' => $this->projectService->create($request->toDto())
        ]);
    }



    /**
     * @OA\Get(
     *     path="/api/project",
     *     tags={"Проекты"},
     *     summary="Получение списка проектов",
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
     *                       @OA\Property(property="countOk", type="integer"),
     *                       @OA\Property(property="countFalse", type="integer"),
     *                       @OA\Property(property="id", type="integer"),
     *                       @OA\Property(property="name", type="string"),
     *                     )
     *                    ),
     *                  ),
     *           ),
     *      )
     * )
     */
    public function list(Request $request)
    {

        return response()->json([
            'result' => $this->projectService->list(empty($request->page) ? 1: intval($request->page), empty($request->search) ? "" : $request->search)
        ]);
    }



}