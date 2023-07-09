<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['Name', 'Notes'];
    public $translatable = ['Name'];


    public function Sections()
    {
        return $this->hasMany(Section::class ,'Grade_id');
    }
    public function classrooms()
    {
        return $this->hasMany(Classroom::class ,'Grade_id');
    }

}
