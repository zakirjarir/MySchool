<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class RoleModules extends Model
{
    use HasFactory;
    protected $table = 'role_modules';
    protected $fillable = [
        'role_id',
        'module_id',
        'status'
    ];



}
