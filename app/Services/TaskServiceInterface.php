<?php

namespace App\Services;

use App\Models\User;
use App\Services\AuthServiceInterface;

interface TaskServiceInterface
{
    public function create($data);

    public function delete($data);

    public function index($attributes);

    public function show($id);

    public function update(array $data, int $id);
}