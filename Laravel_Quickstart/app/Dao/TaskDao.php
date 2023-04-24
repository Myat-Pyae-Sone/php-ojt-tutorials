<?php

namespace App\Dao;

use App\Models\Task;
use App\Contracts\Dao\TaskDaoInterface;
use Illuminate\Support\Facades\Validator;

class TaskDao implements TaskDaoInterface
{
    /**
     * Get task
     * @return object
     */
    public function getTask(): object
    {
        return Task::orderBy('created_at', 'asc')->get();
    }


    /**
     * validate task
     * @param $task
     * @return object
     */
    public function validateTask($request): object
    {
        return
            Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);
    }

    /**
     * Delete task
     * @param $task
     * @return void
     */
    public function deleteTask($task): void
    {
        $task->delete();
    }
}
