<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'enroll'     => $row[0],
            'name'     => $row[1],
            'email'     => $row[2],
            'Phone_No'     => $row[3],
            'course'     => $row[4],
            'semester'     => $row[5],
            'password'     => \Hash::make($row[3]),
        ]);
    }
}
