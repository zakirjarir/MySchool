<?php

namespace App\Http\Controllers\Academic;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\Classes;
use App\Models\Academic\ClassRoom;
use App\Models\Academic\ClassRoutines;
use App\Models\Academic\Day;
use App\Models\Academic\Sections;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class ClassRoutinesController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct()
    {
        $this->model = new ClassRoutines();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $class = $request->input('class');
        $section = $request->input('section');
        $perPage = $request->input('par_page', 10);

        $data = Day::with(['classRoutines' => function ($query) use ($class, $section) {
            if ($class) {
                $query->where('class', $class);
            }
            if ($section) {
                $query->where('section', $section);
            }
        }])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->paginate($perPage);

        return returnData('2000', $data, 'Successfully', 'success');
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
            'day' => 'required',
            'room_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject' => 'required',
            'teacher_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return returnData('5001', 'Validation Failed', $validator->errors(), 'failed');
        }


        $teacher = Teacher::find($request->input('teacher_id'));
        $class = Classes::find($request->input('class_id'));
        $scction = Sections::find($request->input('section_id'));
        $room = ClassRoom::find($request->input('room_id'));


        $data = ClassRoutines::create([
            'day' => $request->input('day'),
            'subject' => $request->input('subject'),
            'room_number' => $room->room_number,
            'class' => $class->name,
            'section' => $scction->name,
            'teacher' => $teacher->name,
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        if ($data) {
            return returnData('2000', 'Created Successfully', 'Routine Created Successfully', 'success');
        }

        return returnData('5004', 'Failed to create routine', [], 'failed');
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
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'room_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject' => 'required',
            'teacher_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return returnData('5001', 'Validation Failed', $validator->errors(), 'failed');
        }


        $teacher = Teacher::find($request->input('teacher_id'));
        $class = Classes::find($request->input('class_id'));
        $scction = Sections::find($request->input('section_id'));
        $room = ClassRoom::find($request->input('room_id'));


        $data = ClassRoutines::create([
            'day' => $request->input('day'),
            'subject' => $request->input('subject'),
            'room_number' => $room->room_number,
            'class' => $class->name,
            'section' => $scction->name,
            'teacher' => $teacher->name,
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        if ($data) {
            return returnData('2000', 'Updated Successfully', 'Routine Created Successfully', 'success');
        }

        return returnData('5004', 'Failed to Update routine', [], 'failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteData($this->model, $id);
    }
}
