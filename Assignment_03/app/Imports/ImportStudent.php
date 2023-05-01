<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudent implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Student([
            'name' => $row['name'],
            'major_id' => Major::where('name', $row['major'])->first()->id,
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
        ]);
    }
}