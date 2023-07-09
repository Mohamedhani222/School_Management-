<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['Name_section', 'Grade_id', 'Classroom_id', 'Status'];
    public $translatable = ['Name_section'];

    public function My_classs()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'teacher_section');

    }

}
