<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    public function role_permissions(){
        return $this->hasMany(RolePermissions::class, 'permission_id', 'id');
    }
    protected $fillable = [
        'module_id',
        'name',
        'display_name',
        'module',
        'status'



    ];
}
