<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    private $taskService;
    /**
     * create a new controller instance
     * @param TaskServiceInterFace $TaskServiceInterface
     */

    public function __construct(TaskServiceInterface $taskServiceInterface)
    {
        $this->taskService = $taskServiceInterface;
    }
    //task page
    public function tasks()
    {
        $tasks = $this->taskService->getTask();
        return view('tasks', compact('tasks'));
    }

    //add task
    public function addTask(Request $request)
    {
        $validator = $this->taskService->validateTask($request);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    // delete task
    public function deleteTask(Task $task)
    {
        $this->taskService->deleteTask($task);
        return redirect('/');
    }
}
