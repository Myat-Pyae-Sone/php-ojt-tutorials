<?php

namespace App\Dao;

use App\Contracts\Dao\MajorDaoInterface;
use App\Models\Major;

class MajorDao implements MajorDaoInterface
{
    /**
     * Get Major list
     * @return object
     */
    public function getMajors(): object
    {
        return Major::orderBy('created_at', 'desc')->paginate(4);

    }

    /**
     * Save Major
     * @param array
     * @return void
     */
    public function createMajor(array $data): void
    {
        Major::create($data);

    }

    /**
     * Update Major
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updateMajor(array $data, $id): void
    {
        $major = Major::findOrFail($id);
        $major->update($data);
    }

    /**
     * Delete Major by id
     * @param int $id
     * @return void
     */
    public function deleteMajorById($id): void
    {
        $major = Major::findOrFail($id);
        $major->delete();

    }
}
