<?php

namespace App\Services;

use App\Models\Task;

class TaskService implements TaskServiceInterface
{
    public function create($request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->user_id = auth()->user()->id;
        $task->save();
    }

    public function delete($id)
    {
        $id->delete();
    }
}