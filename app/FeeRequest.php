<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeRequest extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'enroll';
}
