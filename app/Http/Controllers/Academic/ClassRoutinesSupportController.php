<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\Classes;
use App\Models\Academic\ClassRoom;
use App\Models\Academic\Day;
use App\Models\Academic\Sections;
use App\Models\Academic\Subjects;
use App\Models\Users\Teacher;
use Illuminate\Http\Request;
use function App\Helper\returnData;

class ClassRoutinesSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $class_id  = $request->input('class_id');
        $subject = $request->input('subject');
        $start_time = $request->input('start_time');
        $end_time   = $request->input('end_time');

        $data = [];

        // 🔹 Filter subjects based on class_id
        $data['allSubject'] = Subjects::when($class_id, function ($query) use ($class_id) {
            return $query->where('class_id', $class_id);
        })->get();

        $data['classes'] = Classes::all();
        $data['day'] = Day::all();


        $data['teachers'] = Teacher::when($subject, function ($query) use ($subject) {
            return $query->where('subjects', $subject);
        })
            ->whereNotIn('id', function ($query) use ($start_time, $end_time) {
                $query->select('id')
                ->from('class_routines')
                    ->where(function ($q) use ($start_time, $end_time) {
                        $q->whereBetween('start_time', [$start_time, $end_time])
                            ->orWhereBetween('end_time', [$start_time, $end_time]);
                    });
            })->get();


        $data['section'] = Sections::when($class_id, function ($query) use ($class_id) {
            return $query->where('class_id', $class_id);
        })->get();

        // 🔹 Get available rooms based on the time slot
        $data['rooms'] = ClassRoom::whereNotIn('id', function ($query) use ($start_time, $end_time) {
            $query->select('id')
            ->from('class_routines')
                ->where(function ($q) use ($start_time, $end_time) {
                    $q->whereBetween('start_time', [$start_time, $end_time])
                        ->orWhereBetween('end_time', [$start_time, $end_time]);
                });
        })->get();

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
