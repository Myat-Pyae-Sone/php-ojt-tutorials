<?php

namespace App\Dao;

use App\Contracts\Dao\StudentDaoInterface;
use App\Models\Student;

class StudentDao implements StudentDaoInterface
{
    /**
     * Get Student list
     * @return object
     */
    public function getStudents(): object
    {
        return Student::select('students.*', 'majors.name as major_name')
            ->orderBy('students.created_at', 'asc')
            ->leftjoin('majors', 'students.major_id', 'majors.id')
            ->when(request('key'), function ($query) {
                $query->where('majors.name', 'LIKE', '%' . request('key') . '%')
                    ->orwhere('students.name', 'LIKE', '%' . request('key') . '%')
                    ->orwhere('students.phone', 'LIKE', '%' . request('key') . '%')
                    ->orwhere('students.email', 'LIKE', '%' . request('key') . '%')
                    ->orwhere('students.address', 'LIKE', '%' . request('key') . '%');
            })
            ->paginate(4);

    }

    /**
     * Save Student
     * @param array
     * @return void
     */
    public function createStudent(array $data): void
    {
        Student::create($data);
    }

    /**
     * Update Student
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateStudent(array $data, $id): void
    {
        $student = Student::findOrFail($id);
        $student->update($data);
    }

    /**
     * Delete Student by id
     * @param int $id
     * @return void
     */
    public function deleteStudentById($id): void
    {
        $student = Student::findOrFail($id);
        $student->delete();

    }

}
