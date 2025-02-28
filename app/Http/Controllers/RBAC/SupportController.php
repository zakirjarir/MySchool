<?php
namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use App\Models\RBAC\Modules;
use App\Models\RBAC\Permission;
use App\Models\RBAC\RoleModules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Helper\returnData;

class SupportController extends Controller
{
    public function configurations()
    {
        $user_role = \auth()->user()->role_id;
        $permittedModuleId = DB::table('role_modules')->where('role_id', $user_role)->pluck('module_id')->toArray();
        $data['permissions'] = DB::table('permissions')
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('role_permissions.role_id', $user_role)->get()->pluck('permission');

        $data['modules'] = Modules::where('parent_id', 0)
            ->whereIn('id', $permittedModuleId)
            ->with(['submenus' => function ($query) use ($permittedModuleId) {
                $query->whereIn('id', $permittedModuleId);
            }])->get();

        return returnData('2000', $data, 'Configurations', true);
    }



}
