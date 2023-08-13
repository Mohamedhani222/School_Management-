<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['title', 'amount', 'Grade_id', 'Classroom_id', 'description', 'year','notes','fee_type'];
    public array $translatable = ['title'];

    public function grade() : BelongsTo
    {
        return $this->belongsTo(Grade::class ,'Grade_id');

    }

    public function classroom() :BelongsTo
    {
        return $this->belongsTo(Classroom::class ,'Classroom_id');
    }


}
