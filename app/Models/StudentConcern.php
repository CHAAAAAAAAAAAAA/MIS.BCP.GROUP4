<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentConcern extends Model
{
    protected $fillable = ['student_id', 'concern']; // Ensure student_id exists

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id'); // Defines relationship
    }

}