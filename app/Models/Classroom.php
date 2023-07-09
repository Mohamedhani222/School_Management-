<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['Name_class','Grade_id'];
    public $translatable = ['Name_class'];


    public function grade()
    {
       return $this->belongsTo(Grade::class,'Grade_id');
    }
}
