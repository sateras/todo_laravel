<?php

namespace App\Services;

use App\Models\User;
use App\Services\AuthServiceInterface;

interface TaskServiceInterface
{
    public function create($data);

    public function delete($data);
}