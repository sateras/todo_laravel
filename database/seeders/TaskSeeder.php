<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Task::factory(10)->create();

        \App\Models\Task::factory()->create([
            'category_id' => 1,
            'name' => 'Todo 1',
            'user_id' => 0
        ]);
    }
}