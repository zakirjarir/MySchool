<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'display_name',
        'status',
    ];

    public static function validate($data, $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles,name,' . $id . ',id',
            'display_name' => 'required|string|max:255',
        ]);
    }
}
