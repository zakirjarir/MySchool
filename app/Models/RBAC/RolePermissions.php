<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RolePermissions extends Model
{
    use HasFactory;
    protected $table = 'role_permissions';

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'module_id');
    }
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
}
