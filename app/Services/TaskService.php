<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected TaskRepository $taskRepository
    ) {}

    public function all()
    {
        return $this->taskRepository->all();
    }

    public function store(array $data)
    {
        return $this->taskRepository->store($data);
    }

    public function update(Task $task, array $data)
    {
        return $this->taskRepository->update($task, $data);
    }

    public function delete(Task $task)
    {
        return $this->taskRepository->delete($task);
    }

}
