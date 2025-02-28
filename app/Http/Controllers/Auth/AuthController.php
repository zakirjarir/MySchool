<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class AuthController extends Controller
{
    public function __construct(){
        $this->model = new User();
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'remember_token' => 'nullable',
        ]);

        $email = $request->get('email');

        $st = User::where('email',$email)->first();

        if ($validator->fails()) {
            return returnData('5001', 'Email or Password is not correct',$validator->errors() ,'Validation failed');
        }

        if($st && $st->status == 1){
            $login = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->has('remember_token'));
        }else{
            return returnData('2000', 'User not Activated' ,'User not Activated','false');
        }
        if ($login) {
            if ($request->has('remember_token')) {
                return returnData('2000', '' ,'Login success with remember token','success');
            }
            return returnData('2000', '' ,'Login success','success');
        }
        return returnData('2000', 'Email or Password is not correct' ,'Email or Password is not correct','false');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return returnData('2000', 'Logout Success', 'Logout Success', 'true');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
