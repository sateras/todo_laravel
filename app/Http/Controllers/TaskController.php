<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTagToTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\IndexTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index(IndexTaskRequest $request)
    {
        $data = $request->validated();

        return $this->service->index($data);
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function create(CreateTaskRequest $request)
    {
        $data = $request->validated();

        return $this->service->create($data);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $request->validated();

        return $this->service->update($data, $id);
    }

    public function delete(Task $id)
    {
        return $this->service->delete($id);
    }

    public function addTagToTask(AddTagToTaskRequest $request, $id)
    {
        $data = $request->validated();

        return $this->service->addTagToTask($data, $id);
    }
}