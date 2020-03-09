<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocRequest extends Model
{
    use Notifiable,SoftDeletes;

    protected $primaryKey = 'Req_id';

    protected $fillable = [
        'Req_id','enroll', 'faculty_id','lorpdf_path','status','type','completedby','paydate','tran_id','amount',
    ];
}
