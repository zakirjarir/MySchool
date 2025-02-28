<?php

namespace App\Http\Controllers\Academic;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class SyllabusController extends Controller
{
    use Helper;
    Use TraitSupport;

    public function __construct()
    {
        $this->model = new Syllabus();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $class =  $request->input('class');
        $subject = $request->input('subject');
        $perPage = $request->input('par_page', 10);

        $data = Syllabus::when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('class', 'like', '%' . $keyword . '%')
                    ->orWhere('subject', 'like', '%' . $keyword . '%');
            });
        })
            ->when($class, function ($query) use ($class) {
                $query->where('class', 'like', '%' . $class . '%');
            })
            ->when($subject, function ($query) use ($subject) {
                $query->where('subject', 'like', '%' . $subject . '%');
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
        $rulse = [
            'title' => 'required',
            'class' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'file_path' => 'required',
            ];

        return $this->StoreData($request ,$this->model ,$rulse);
    }


    /**
     * Display the specified resource.
     */
    public function show(Syllabus $syllabus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Syllabus $syllabus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $rulse = [
            'title' => 'required',
            'class' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ];

        return $this->dataUpdate($request ,$this->model ,$rulse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return $this->deleteData( Syllabus::class ,  $id);
    }
}
