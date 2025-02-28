<?php

namespace App\Http\Controllers\RBAC;
use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\RBAC\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function App\Helper\can;
use function App\Helper\returnData;

class UserController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new User();

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
        $role_id = $request->input('role_id');
        $keyword = $request->input('keyword');
        $perPage = $request->par_page;
        $data = $this->model
            ->when($role_id, function ($query) use ($role_id) {
                $query->where('role_id', $role_id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->paginate($perPage);

        return returnData(2000, $data, 'success', 'Data retrieved successfully');
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
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        if ($validate->fails()) {
            return returnData('5001', 'false', $validate->errors(), 'Validation failed');
        }
       $role_id = $request->input('role_id');
        $getRole = Roles::where('id', $role_id)->first();

       $creatUser =  $this->model->create([
            'name' => $request->input('name'),
            'role'=>$getRole->display_name,
            'role_id' => $role_id,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

       if ($creatUser) {
           return returnData('2000', 'true', 'User has been created successfully', 'success');
       }

       return returnData('5001', 'false', 'Unable to create user', 'error');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return returnData('5001','failed',$validator->errors(),'Validation failed');
        }

        $user = User::where('id', $id)->first();

        if (!$user) {
            return returnData('5001', 'false', 'User not found', 'error');
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return returnData('5001', 'false', 'Old password is incorrect', 'error');
        }

        $role_id = $request->input('role_id');
        $getRole = Roles::where('id', $role_id)->first();

        if (!$getRole) {
            return returnData('5001', 'false', 'Role not found', 'error');
        }

        $user->update([
            'name' => $request->input('name'),
            'role' => $getRole->display_name,
            'role_id' => $role_id,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('new_password')),
        ]);

        return returnData('2000', 'true', 'User has been updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id == 1){
            return returnData('5001', 'false', 'This is Owner', 'Owner');
        }
        return $this->deleteData($this->model, $id);
    }
}
