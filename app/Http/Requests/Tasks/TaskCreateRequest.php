<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\TaskDto;

class TaskCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'project_id' => 'required|integer|exists:Projects,id',
        ];
    }

    public function toDTO(): TaskDto
    {
        return new TaskDto(
            $this->get('name'),
            $this->get('description'),
            $this->get('project_id')
        );
    }
}
