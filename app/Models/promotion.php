<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;

    public $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function f_grade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function t_grade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function f_class()
    {
        return $this->belongsTo(Classroom::class, 'from_class');
    }

    public function t_class()
    {
        return $this->belongsTo(Classroom::class, 'to_class');
    }

    public function f_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function t_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }


}
