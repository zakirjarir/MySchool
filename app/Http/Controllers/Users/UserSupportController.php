<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Academic\Classes;
use App\Models\Academic\Sections;
use App\Models\Academic\Subjects;
use App\Models\Users\Students;
use Illuminate\Http\Request;
use function App\Helper\returnData;

class UserSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['allSubjects'] = Subjects::all();
        $data['allClasses'] = Classes::all();
        $data['allSection'] = Sections::all();
        $data['allStudent'] = Students::all();
        return returnData('2000',$data ,'success' ,'success');
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
