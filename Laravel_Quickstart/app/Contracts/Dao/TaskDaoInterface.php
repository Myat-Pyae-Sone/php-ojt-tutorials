<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for task
 */
interface TaskDaoInterface
{
    /**
     * Get task list
     * @return object
     */
    public function getTask(): object;

    /**
     *validate task
     * @param int $id
     * @return object
     */
    public function validateTask($request): object;

    /**
     * Delete user
     * @param @task
     * @return void
     */
    public function deleteTask($task): void;
}
