<?php

namespace App\Http\Controllers\API;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\API\Task\IndexTaskRequest;
use App\Http\Requests\API\Task\StoreTaskRequest;
use App\Http\Requests\API\Task\UpdateTaskRequest;
use App\Http\Resources\Task\IndexTaskResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(IndexTaskRequest $request): AnonymousResourceCollection
    {
        return IndexTaskResource::collection(
            resource: Task::filter(
                app()->make(
                    TaskFilter::class,
                    ['queryParams' => array_filter($request->validated())]
                ))->get());
    }

    public function store(StoreTaskRequest $request): TaskResource
    {
        return new TaskResource(
            resource: Task::query()->create([
                'name' => $request->validated('name'),
                'status' => TaskStatusEnum::Process,
            ]));
    }

    public function show(Task $task): TaskResource
    {
        return new TaskResource(
            resource: $task
        );
    }

    public function update(UpdateTaskRequest $request, Task $task): TaskResource
    {
        return new TaskResource(
            resource: $task->update(
                $request->validated()
            ));
    }

    public function delete(Task $task): Response
    {
        $task->delete();

        return response(
            status: Response::HTTP_NO_CONTENT
        );
    }
}
