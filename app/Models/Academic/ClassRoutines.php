<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRoutines extends Model
{
    use HasFactory;
    protected $table = 'class_routines';
    protected $fillable = [
        'class_id',
        'subject',
        'class',
        'section',
        'teacher',
        'room_number',
        'day',
        'start_time',
        'end_time'
    ];

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class, 'day_id', 'id');
    }

}
