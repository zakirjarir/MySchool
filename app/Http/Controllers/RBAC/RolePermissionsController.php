<?php

namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use App\Models\RBAC\Modules;
use App\Models\RBAC\RoleModules;
use App\Models\RBAC\RolePermissions;
use Illuminate\Http\Request;
use function App\Helper\can;
use function App\Helper\returnData;

class RolePermissionsController extends Controller
{
    public function __construct()
    {
        $this->model = new RoleModules();
        $this->childModel = new RolePermissions();
//        $this->middleware(function ($request, $next) {
//            if (!can(request()->route())){
//                return returnData(4001, null, 'You are not authorized to access this page');
//            }
//            return $next($request);
//        });

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $role_id = $request->input('role_id');
            $keyword = $request->input('keyword');

            $data['modules'] = $this->model->where('role_id', $role_id)
                ->get()->pluck('module_id')
                ->toArray();

            $data['permissions'] = $this->childModel->where('role_id', $role_id)
                ->get()->pluck('permission_id')
                ->toArray();

            $data['all_modules'] = Modules::where('parent_id', 0)
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('name', 'Like', "%$keyword%");
                    $query->orWhere('display_name', 'Like', "%$keyword%");
                })
                ->with('permissions')
                ->with(['submenus' => function ($query) use ($keyword) {
                    $query->when($keyword, function ($query) use ($keyword) {
                        $query->where('name', 'Like', "%$keyword%");
                        $query->orWhere('display_name', 'Like', "%$keyword%");
                    });
                    $query->with('permissions');

                    $query->with(['submenus'=>function($query) use ($keyword){
                        $query->when($keyword, function ($query) use ($keyword) {
                            $query->where('name', 'Like', "%$keyword%");
                            $query->orWhere('display_name', 'Like', "%$keyword%");
                        });
                        $query->with('permissions');
                    }]);
                }])
                ->paginate($request->input('par_page'));

            return returnData(2000, $data);

        } catch (\Exception $exception) {
            return returnData(5000, $exception->getMessage(), 'Whoops, Something Went Wrong..!!');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function roleChange(Request $request)
    {
        $role_id = $request->input('role_id');
        $permission_id = $request->input('permission_id');
        $module_id = $request->input('module_id');
        $type = $request->input('type');

        $changeModule = RoleModules::where('module_id', $module_id)->where('role_id', $role_id)->first();
        $changePermission = RolePermissions::where('permission_id', $permission_id)->where('role_id', $role_id)->first();

        if ($role_id !== null) {
            if ($type == 'insert') {
                if ($permission_id == null) {
                    RoleModules::create([
                        'role_id' => $role_id,
                        'module_id' => $module_id,
                    ]);
                    return returnData(2000 , 'success', 'Role Module has been created.' ,'success');

                } else {
                    RolePermissions::create([
                        'role_id' => $role_id,
                        'permission_id' => $permission_id,
                    ]);
                    return returnData(2000 , 'success', 'Permission has been created.' ,'success');
                }
            } elseif ($type == 'remove') {
                if ($permission_id == null && $changeModule) {
                    $changeModule->delete();

                    return returnData(2000 , 'success', 'Role Module has been deleted.' ,'success');

                } elseif ($changePermission) {
                    $changePermission->delete();
                    return returnData(2000 , 'success', 'Permission has been deleted.' ,'success');
                }
            } else {
                return returnData(50001 , 'false', 'Invalid operation type.' ,'false');
            }
        }
        return returnData(50001 , 'false', 'Please select role.' ,'false');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role_id = $request->input('role_id');
        $permission_id = $request->input('permission_id');
        $module_id = $request->input('module_id');
        $type = $request->input('type');

        $changeModule = RoleModules::where('module_id', $module_id)->where('role_id', $role_id)->first();
        $changePermission = RolePermissions::where('permission_id', $permission_id)->where('role_id', $role_id)->first();

        if ($role_id !== null) {
            if ($type == 'insert') {
                if ($permission_id == null) {
                    RoleModules::create([
                        'role_id' => $role_id,
                        'module_id' => $module_id,
                    ]);
                    return returnData(2000 , 'success', 'Role Module has been created.' ,'success');

                } else {
                    RolePermissions::create([
                        'role_id' => $role_id,
                        'permission_id' => $permission_id,
                    ]);
                    return returnData(2000 , 'success', 'Permission has been created.' ,'success');
                }
            } elseif ($type == 'remove') {
                if ($permission_id == null && $changeModule) {
                    $changeModule->delete();

                    return returnData(2000 , 'success', 'Role Module has been deleted.' ,'success');

                } elseif ($changePermission) {
                    $changePermission->delete();
                    return returnData(2000 , 'success', 'Permission has been deleted.' ,'success');
                }
            } else {
                return returnData(50001 , 'false', 'Invalid operation type.' ,'false');
            }
        }
        return returnData(50001 , 'false', 'Please select role.' ,'false');
    }

    /**
     * Display the specified resource.
     */
    public function show(rolePermissions $role_permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rolePermissions $role_permissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rolePermissions $role_permissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rolePermissions $role_permissions)
    {
        //
    }
}
