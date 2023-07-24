<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskListRequest;
use App\Models\TaskList;
use App\Services\TaskListService;

class TaskListController extends Controller
{
    protected $service;

    public function __construct(TaskListService $service)
    {
        $this->service = $service;
    }

    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $taskLists = $this->service->index();

        return $taskLists;
    }

    public function create(CreateTaskListRequest $request)
    {
        $data = $request->validated();

        return $this->service->create($data);
    }

    public function update(CreateTaskListRequest $request, $id)
    {
        $data = $request->validated();

        return $this->service->update($data, $id);
    }

    public function delete(TaskList $id)
    {
        return $this->service->delete($id);
    }
}
