<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable
{
    
    use Notifiable;

    protected $primaryKey = 'enroll';
    protected $guard = 'student';

    protected $fillable = [
        'enroll','name', 'email','Phone_No','course','semester','password',
    ];
}
