<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\TaskTimestampDto;

class TaskTimestampRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'task_id' => 'required|exists:Tasks,id',
            'watch' => 'required|integer',
        ];
    }

    public function toDTO(): TaskTimestampDto
    {
        return new TaskTimestampDto(
            $this->get('task_id'),
            $this->get('watch'),
            \Auth::user()->id
        );
    }
}
