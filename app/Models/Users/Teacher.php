<?php

namespace App\Models\Users;

use App\Models\Academic\Subjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'teacher_id',
        'name',
        'email',
        'phone',
        'gender',
        'dob',
        'blood_group',
        'nid',
        'address',
        'profile_picture',
        'qualification',
        'designation',
        'department',
        'subjects',
        'joining_date',
        'salary',
        'username',
        'password',
        'role_id',
        'permissions',
        'status',
    ];

    // 🔹 Add Many-to-Many Relationship with Subjects
    public function subjects()
    {
        return $this->belongsToMany(Subjects::class, 'teachers_subjects', 'teacher_id', 'subject_id');
    }


}
