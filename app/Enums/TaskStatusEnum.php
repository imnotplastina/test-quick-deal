<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Process = 'В процессе';
    case Completed = 'Завершен';
    case Canceled = 'Отменен';
}
