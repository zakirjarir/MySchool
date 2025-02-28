<?php

namespace App\Models\RBAC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Validator;

class Modules extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $fillable = [
        'icon',
        'name',
        'display_name',
        'link',
        'parent_id',
        'status'

    ];
    public static function validate($data, $id = null)
    {
        return Validator::make($data, [
            'display_name' => 'required|string|max:255|unique:modules,display_name,' . $id . ',id',
            'id' => 'required|exists:modules,id',
        ]);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'module_id');
    }

    public function submenus()
    {
        return $this->hasMany(Modules::class, 'parent_id', 'id');
    }
}
