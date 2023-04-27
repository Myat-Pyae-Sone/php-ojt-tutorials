<?php

namespace App\Dao;

use App\Contracts\Dao\TaskDaoInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskDao implements TaskDaoInterface
{
    /**
     * function Get task
     * @return object
     */
    public function getTask(): object
    {
        return Task::orderBy('created_at', 'asc')->get();
    }

    /**
     * function validate task
     * @param $task
     * @return object
     */
    public function validateTask($request): object
    {
        return
        Validator::make($request->all(), [
            'name' => 'required|max:255',
        ], [
            'name.required' => 'Task Name field is required!',
        ]);
    }

    /**
     * function Delete task
     * @param $task
     * @return void
     */
    public function deleteTask($id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }
}
