<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStudent implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Student([
            'name' => $row[1],
            'major_id' => $row[2],
            'phone' => $row[3],
            'email' => $row[4],
            'address' => $row[5],
        ]);
    }
}
