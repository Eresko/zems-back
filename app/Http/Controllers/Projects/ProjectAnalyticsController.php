<?php

namespace App\Http\Controllers\Projects;


use Illuminate\Http\Request;
use App\Http\Requests\Project\ProjectRequest;
use Illuminate\Support\Carbon;
use App\Services\ProjectService;

class ProjectAnalyticsController {

    public function __construct(
        protected ProjectService $projectService
    ) {
    }
    /**
     * @OA\Get(
     *     path="/api/project-analytics",
     *     tags={"Аналитика"},
     *     summary="создвание проекта",
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
    public function get(Request $request)
    {

        return response()->json([
            'result' => $this->projectService->getAnalytics(empty($request->page) ? 1: intval($request->page), empty($request->search) ? "" : $request->search)
        ]);
    }


}