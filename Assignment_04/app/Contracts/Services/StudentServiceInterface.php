<?php

namespace App\Contracts\Services;

/**
 * Interface for user service
 */
interface StudentServiceInterface
{
    /**
     * Get Student list
     * @return object
     */
    public function getStudents(): object;

    /**
     * Save Student
     * @param array $data
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
}
