<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }
    public function create(CreateTaskRequest $request)
    {
        $request->validated();

        $this->service->create($request);

        return redirect(route('home'));
    }

    public function delete(Task $id)
    {
        $this->service->delete($id);

        return redirect(route('home'));
    }
}