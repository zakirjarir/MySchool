<?php

namespace App\Http\Controllers\Users;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Mail\StudentRegistrationMail;
use App\Models\Academic\Classes;
use App\Models\Academic\Sections;
use App\Models\Academic\Subjects;
use App\Models\Users\Students;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class StudentsController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new Students();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $class =  $request->input('class');
        $section = $request->input('section');
        $perPage = $request->input('par_page', 10);

        $data = Students::when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('roll_no', 'like', '%' . $keyword . '%');
            });
        })
            ->when($class, function ($query) use ($class) {
                $query->where('class', 'like', '%' . $class . '%');
            })
            ->when($section, function ($query) use ($section) {
                $query->where('section', 'like', '%' . $section . '%');
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
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string',
            'class' => 'required|exists:classes,name',
            'section' => 'nullable|exists:sections,name',
            'blood_group' => 'nullable|string|max:3',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:15',
            'guardian_relation' => 'nullable|string|max:255',
            'guardian_address' => 'nullable|string',
        ]);

        if($validData->fails()){
            return returnData('5001','validation error',$validData->errors(),'failed');
        }

        $student_id  = $this->genRandNum('STU-' ,'', 1000 , 999,'student_id');
        $admission_no = $this->genRandNum('' ,'', 100 , 99,'admission_no');
        $roll =$this->genRandNum('' ,'', 10, 9,'roll_no');

        $student = new Students();
        $student->fill($request->all());
        $student->student_id = $student_id;

        $student->admission_no = $admission_no;
        $student->admission_date = Carbon::now();
        $student->roll_no = $roll ;
       $saveStu =  $student->save() ;
        if($saveStu){
//            $student->class = Classes::where('id', $request->input('class_id'))->value('name');
//            $student->section = Sections::where('id', $request->input('section_id'))->value('name');
//            $student->student_id = $student_id;
//
//            Mail::to($student->email)->send(new StudentRegistrationMail($student));
           return returnData('2000','student saved successfully','student saved successfully','success');
        }
       return returnData('5002','student save failed','student save failed','failed');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Students::find($id);
        return returnData('2000', $data, 'success', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteData(Students::class, $id);
    }
}
