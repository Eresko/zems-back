<?php

declare(strict_types=1);

namespace App\Http\Requests\Project;


use App\Http\Requests\BaseRequest;
use Illuminate\Support\Carbon;
use App\Dto\ProjectDto;

class ProjectRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function toDTO(): ProjectDto
    {
        return new ProjectDto(
            $this->get('name'),
            $this->get('description'),
            \Auth::user()->id
        );
    }
}
