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
        $dlstud = Student::withTrashed()->where('enroll',$row[0])->first(); 
        if($dlstud) {
            $dlstud->forceDelete();
        }
        $stud = Student::find($row[0]);
        if ($stud) {
            $stud->name = $row[1];
            $stud->email = $row[2];
            $stud->Phone_No = $row[3];
            $stud->password = \Hash::make($row[3]);
            $stud->course = $row[4];
            $stud->semester = $row[5];
            $stud->update();
            return $stud;
        } else {
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
}
