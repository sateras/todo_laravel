<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'completed'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}