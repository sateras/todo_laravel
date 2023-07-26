<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskList;
use Storage;

class TaskService implements TaskServiceInterface
{
    public function create($data)
    {
        $data['user_id'] = auth()->user()->id;

        if (isset($params['image'])) {
            
        }

        if (isset($params['tags'])) {
            
        }

        return Task::create($data);
    }

    public function delete($id)
    {
        $id->delete();
    }

    public function index($attributes)
    {
        $query = Task::with('image', 'tags');

        if (isset($attributes['filter'])) {
            $query->where('name', 'LIKE', '%' . $attributes['filter'] . '%');
        }

        if (isset($attributes['tag_ids'])) {
            $query->whereHas('tags', function ($query) use ($attributes) {
                $query->whereIn('tag_id', $attributes['tag_ids']);
            });
        }

        return $query->get();
    }

    public function show($id)
    {
        $tasks = TaskList::find($id)->tasks()->with('image', 'tags')->get();

        return $tasks;
    }

    public function update(array $data, int $id)
    {
        $task = Task::findOrFail($id);
    
        if ($data['name']) {
            $task->name = $data['name'];
        }
    
        if ($data['description']) {
            $task->description = $data['description'];
        }
    
        if ($data['tags']) {
            $existingTags = $task->tags->pluck('name')->toArray();
            $newTags = $data['tags'];
    
            foreach ($newTags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                if (!in_array($tagName, $existingTags)) {
                    $task->tags()->attach($tag->id);
                }
            }
    
            $tagsToRemove = array_diff($existingTags, $newTags);
            foreach ($tagsToRemove as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $task->tags()->detach($tag->id);
                }
            }
        }
    
        $task->save();

        return response()->json(['message' => 'Задача успешно обновлена']);
    }

    public function addTagToTask($data, $id)
    {
        $tag_name = $data['tag'];
    
        $tag = Tag::where('name', $tag_name)->first();
        $task = Task::findOrFail($id);

        if ($tag) {
            $task->tags()->attach($tag->id);
        } else {
            $tag = Tag::create(['name' => $tag_name]);
            $task->tags()->attach($tag->id);
        }
    
        return response()->json(['message' => 'Тег успешно добавлен к задаче']);
    }

    public function addImageToTask($data, $id)
    {
        $task = Task::findOrFail($id);

        if ($data['image']) {
            $file = $data['image'];

            if ($file->isValid() && $file->getClientMimeType() === 'image/jpeg' || $file->getClientMimeType() === 'image/png') {
                
                $imagePath = $file->store('public/images');

                $image = new Image([
                    'path' => asset(Storage::url($imagePath)),
                    'task_id' => $id,
                    'thumbnail_path' => asset(Storage::url($imagePath))
                ]);

                $task->image()->save($image);

                return response()->json(['message' => 'Изображение успешно добавлено к задаче']);
            } else {
                return response()->json(['error' => 'Неверный формат изображения'], 400);
            }
        } else {
            return response()->json(['error' => 'Файл изображения не был загружен,' . $data['image']->getClientOriginalName()], 400);
        }
    }
}