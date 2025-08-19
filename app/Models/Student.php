<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'last_name',
        'first_name',
        'email',
        'year_level',
        'course',
        'strand',
        'roles',
    ];

}
