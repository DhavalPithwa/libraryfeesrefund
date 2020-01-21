<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'enroll';
    protected $guard = 'student';

    protected $fillable = [
        'enroll','name', 'email','Phone_No','course','semester','password',
    ];
}
