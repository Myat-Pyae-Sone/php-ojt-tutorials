<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Http\Request;

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

    /**
     * tasks function
     * @return object
     */
    public function tasks()
    {
        $tasks = $this->taskService->getTask();
        return view('tasks', compact('tasks'));
    }

    /**
     * add task function
     * @return object
     */
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

        return redirect('/')->with(['createSuccess' => 'Task create successfully!']);
    }

    /**
     * delete task function
     * @return object
     */
    public function deleteTask($id)
    {
        $this->taskService->deleteTask($id);
        return redirect('/')->with(['deleteSuccess' => 'Task delete successfully!']);
    }
}
