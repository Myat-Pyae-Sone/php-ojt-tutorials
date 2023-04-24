<?php

namespace App\Contracts\Services;

/**
 * Interface for task service
 */
interface TaskServiceInterface
{
    /**
     * Get task
     * @return object
     */
    public function getTask(): object;

    /**
     * validate task
     * @param int $id
     * @return object
     */
    public function validateTask($request): object;


    /**
     * Delete task
     * @param $task
     * @return void
     */
    public function deleteTask($task): void;
}
