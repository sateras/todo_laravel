<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskList;
use App\Models\User;

class TaskListService
{
    private $model;

    public function __construct(TaskList $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return auth()->user()->taskLists;
    }

    public function create(array $data)
    {
        return auth()->user()->taskLists()->create($data);
    }

    public function update(array $data, int $id)
    {
        return auth()->user()->taskLists()->find($id)->update($data);
    }

    public function delete($id)
    {
        $id->delete();
    }
}