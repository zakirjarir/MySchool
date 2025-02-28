<?php

namespace App\Http\Controllers\Users;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Users\Parents;
use App\Models\Users\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class ParentsController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new Parents();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $student_id = $request->input('student_id.id') ? $request->input('student_id.id') : null;
        $perPage = $request->input('par_page', 10);

        $data = Parents::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
            ->when($student_id, function ($query) use ($student_id) {
                $query->where('student_id', $student_id);
            })
            ->paginate($perPage);

        return returnData('2000', $data, 'success', 'success');
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
        $validData = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:parents,email',
            'phone' => 'required',
            'address' => 'required|string|max:500',
//            'student_id' => 'required|exists:students,id',
//            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validData->fails()){
            return returnData('5001','validation error',$validData->errors(),'failed');
        }
        do {
            $parent_id = 'PAR-' . time() . rand(10, 99);
        } while (Parents::where('parent_id', $parent_id)->exists());




        $student = $request->input('student_id');

        if (!isset($student['id'])) {
            return returnData('5001', 'Student ID is required', 'Validation Error', 'failed');
        }

        $student_id = $student['id'];


        $parents = new Parents();
        $parents->fill($request->all());
        $parents->student_id = $student_id;
        $parents->parent_id = $parent_id;
        return $parents->save() ? returnData('2000','Parents saved successfully','Parents saved successfully','success') : returnData('5002','Parents save failed','Parents save failed','failed');


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
       return $this->deleteData($this->model,$id);
    }
}
