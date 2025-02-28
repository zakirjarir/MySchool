<?php

namespace App\Http\Controllers\RBAC;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\RBAC\Modules;
use App\Models\RBAC\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helper\can;
use function App\Helper\returnData;

class ModulesController extends Controller
{
    use Helper;
    use TraitSupport;

    public function __construct(){
        $this->model = new Modules();
        $this->childModel = new Permission();

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
        $keyword = $request->input('keyword');

        $data = $this->model
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'Like', "%$keyword%");
                $query->orWhere('display_name', 'Like', "%$keyword%");
            })
            ->with('permissions')
            ->with(['submenus'=>function($query) use ($keyword){
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
            }])->get();

        return returnData('2000', $data, 'success', true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'display_name'=>'required |string|unique:modules',
            'module_id'=>'required | integer|exists:modules,id',
        ]);
        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }
        $saveData = Permission::create([
            'module_id' => $request->input('module_id'),
            'display_name' => $request->input('display_name'),
        ]);
        if($saveData){
            return returnData('2000','success','Module has been created successfully!','success');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(modules $modules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id )
    {
        return $this->changeStatus(Modules::class, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(modules $modules)
    {
        //
    }
}
