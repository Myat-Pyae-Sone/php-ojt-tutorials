<?php

namespace App\Services;

use App\Contracts\Dao\StudentDaoInterface;
use App\Contracts\Services\StudentServiceInterface;

/**
 * Student Service class
 */
class StudentService implements StudentServiceInterface
{
    /**
     * Student Dao
     */
    private $studentDao;

    /**
     * Class Constructor
     * @param StudentDaoInterface
     * @return void
     */
    public function __construct(StudentDaoInterface $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    /**
     * Get Student list
     * @return object
     */
    public function getStudents(): object
    {
        return $this->studentDao->getStudents();
    }

    /**
     * Save Student
     * @param array
     * @return void
     */
    public function createStudent(array $data): void
    {
        // Mail Send Code
        $this->studentDao->createStudent($data);
    }

    /**
     * Get Student by id
     * @param int $id
     * @return object
     */
    public function getStudentById(int $id): object
    {

    }

    /**
     * Update Student
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, int $id): void
    {
        $this->studentDao->updateStudent($data, $id);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById(int $id): void
    {
        $this->studentDao->deleteStudentById($id);
    }

}
