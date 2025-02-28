<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'roll_no',
        'class',
        'section',
        'admission_no',
        'admission_date',
        'blood_group',
        'guardian_name',
        'guardian_phone',
        'guardian_relation',
        'guardian_address',
        'photo',
    ];
}
