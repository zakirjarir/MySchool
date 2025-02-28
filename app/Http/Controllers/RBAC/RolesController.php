<?php

namespace App\Http\Controllers\RBAC;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\RBAC\Roles;
use Illuminate\Http\Request;
use function App\Helper\can;
use function App\Helper\returnData;

class RolesController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new Roles();
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
        $data = $this->model->when($keyword,function ($query) use ($keyword){
            $query->where('name','like','%'.$keyword.'%');
        }) ->paginate($request->input('par_page'));;
        return returnData('2000',$data,'success','success');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rulse = [
          'name'=>'required|string|unique:roles,name',
            'display_name'=>'required|string',
        ];

       return $this->StoreData($request,$this->model ,$rulse);
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string   $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Roles::validate($request->all(), $id);

        if ($validator->fails()) {
            return returnData('5001' ,'failed' , $validator->errors() ,'failed');
        }
        $role = Roles::findOrFail($id);
        $role->update($request->only(['name', 'display_name', 'status']));
        return returnData('2000','success','Role updated successfully!' ,'success');
    }
    public function destroy(string   $id)
    {
        if($id == 1){
            return returnData('5001', 'false', 'This is Owner', 'Owner');
        }
        return $this->deleteData($this->model,$id);
    }

}
