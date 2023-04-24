<?php

namespace App\Services;

use App\Contracts\Dao\TaskDaoInterface;
use App\Contracts\Services\TaskServiceInterface;

/**
 * Task Service class
 */
class TaskService implements TaskServiceInterface
{
    /**
     * task Dao
     */
    private $taskDao;

    /**
     * Class Constructor
     * @param TaskDaoInterface
     * @return void
     */
    public function __construct(TaskDaoInterface $taskDao)
    {
        $this->taskDao = $taskDao;
    }

    /**
     * Get task list
     * @return object
     */
    public function getTask(): object
    {
        return $this->taskDao->getTask();
    }
    /**
     * validate task
     * @param $request
     * @return object
     */
    public function validateTask($request): object
    {
        return $this->taskDao->validateTask($request);
    }


    /**
     * Delete task
     * @param $task
     * @return void
     */
    public function deleteTask($task): void
    {
        $this->taskDao->deleteTask($task);
    }
}
