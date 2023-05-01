<?php

namespace App\Contracts\Dao;

/**
 * Interface of Data Access Object for user
 */
interface StudentDaoInterface
{
    /**
     * Get Student list
     * @return object
     */
    public function getStudents(): object;

    /**
     * Save Student
     * @param array
     * @return void
     */
    public function createStudent(array $data): void;

    /**
     * Update Student
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, int $id): void;

    /**
     * Delete Student by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById(int $id): void;

    /**
     * search Student by id
     * @param int $id
     * @return object
     */

}
