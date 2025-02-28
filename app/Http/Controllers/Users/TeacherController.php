<?php

namespace App\Http\Controllers\Users;
use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\Classes;
use App\Models\Academic\Subjects;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use function App\Helper\returnData;

class TeacherController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new Teacher();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $class = Classes::where('id', $request->input('department'))->first(); ;
        $subject =  Subjects::where('id', $request->input('subject'))->first();;
        $perPage = $request->input('par_page', 10);
        $getClass = $class ? $class->name : null;
        $getSubject = $subject ? $subject->name : null;
        $data = Teacher::when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        })
            ->when($class, function ($query) use ($getClass) {
                $query->where('department', 'like', '%' . $getClass . '%');
            })
            ->when($subject, function ($query) use ($getSubject) {
                $query->where('subjects', 'like', '%' . $getSubject . '%');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'nid' => 'nullable|string|max:50|unique:teachers,nid',
            'address' => 'required|string|max:500',
            'profile_picture' => 'nullable|string',
            'qualification' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'class' => 'required',
            'subject' => 'required|integer|exists:subjects,id',
            'joining_date' => 'required|date',
            'salary' => 'nullable|numeric|min:0',
            'role' => 'required|integer|in:1,2',
        ]);

        if ($validator->fails()) {
            return returnData('5001', 'Validation Error', $validator->errors(), 'Validation Error');
        }

        $getClass = Classes::where('id', $request->class)->first();
        $getSub = Subjects::where('id',$request->subject)->first();

        $username = Str::slug($request->name);
        $username .= Teacher::where('username', 'LIKE', "{$username}%")->count() ?: '';

        do {
            $teacher_id = 'TCH-' . time() . rand(100, 999);
        } while (Teacher::where('teacher_id', $teacher_id)->exists());

        $teacher = new Teacher();
        $teacher->fill($request->all());
        $teacher->teacher_id = $teacher_id;
        $teacher->username = $username;
        $teacher->role_id = $request->role;
        $teacher->department = $getClass->name;
        $teacher->subjects = $getSub->name;

        return $teacher->save()
            ? returnData('2000', 'success', 'Teacher has been created', 'success')
            : returnData('5001', 'error', 'Woops..! There Was An Error', 'error');
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
        return $this->deleteData($this->model, $id);
    }
}
