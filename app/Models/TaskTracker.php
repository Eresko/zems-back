<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskTracker extends Model
{
    protected $table = 'task_trackers';

    protected $fillable = [
        'task_id',
        'task_id',
        'user_id',
        'watch',
    ];

}