<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $table = 'parents';

    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'address',
        'profile_photo',
        'password',
        'status',
        'student_id',
    ];
}
