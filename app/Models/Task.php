<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static filter(mixed $make)
 */
class Task extends Model
{
    use Filterable;

    protected $fillable = [
        'name', 'status',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];
}
