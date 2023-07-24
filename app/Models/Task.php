<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'task_list_id', 'description', 'completed'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}