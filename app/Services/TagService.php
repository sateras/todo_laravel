<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    // public function create($data)
    // {
    //     $data['user_id'] = auth()->user()->id;

    //     if (isset($params['image'])) {
            
    //     }

    //     if (isset($params['tags'])) {
            
    //     }

    //     return Task::create($data);
    // }

    // public function delete($id)
    // {
    //     $id->delete();
    // }

    public function index()
    {
        // $query = Tag::with('tasks');

        // if (isset($attributes['filter'])) {
        //     $query->where('name', 'LIKE', '%' . $attributes['filter'] . '%');
        // }

        return Tag::all();
    }

    // public function show($id)
    // {
    //     $tasks = TaskList::find($id)->tasks()->with('image', 'tags')->get();

    //     return $tasks;
    // }

    // public function update(array $data, int $id)
    // {
    //     return auth()->user()->taskLists()->find($id)->update($data);
    // }
}