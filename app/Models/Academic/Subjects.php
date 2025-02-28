<?php

namespace App\Models\Academic;

use App\Models\Users\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'class_id'
    ];

    // 🔹 Many-to-Many Relationship with Teachers
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teachers_subjects', 'subject_id', 'teacher_id');
    }

}
