<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

final class TaskFilter extends AbstractFilter
{
    private const STATUS = 'status';

    protected function getCallbacks(): array
    {
        return [
            self::STATUS => [$this, 'status'],
        ];
    }

    protected function status(Builder $builder, $value): void
    {
        $builder->where('status', $value);
    }
}
