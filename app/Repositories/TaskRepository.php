<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function all()
    {
        return Task::latest()->select('*');
    }

    public function store(array $data)
    {
        return Task::create($data);
    }

    public function update($task, array $data)
    {
        $task->update($data);

        return $task;
    }

    public function delete($task)
    {
        return $task->delete();
    }
}
