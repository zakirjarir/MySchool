<?php

namespace App\Http\Controllers\Academic;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\Subjects;
use Illuminate\Http\Request;
use function App\Helper\returnData;

class SubjectsController extends Controller
{
    use Helper;
    use TraitSupport;
    public function __construct(){
        $this->model = new Subjects();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $class_id = $request->input('class_id');
        $perPage = $request->input('par_page');


        $data = Subjects::when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('code', 'like', '%' . $keyword . '%');
            });
        })->when($class_id, function ($query) use ($class_id) {
                $query->where('class_id', 'like', '%' . $class_id . '%');
            })->paginate($perPage);
        return returnData('2000',$data,'Successfully','success');
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
        $rules = [
            'name' => 'required',
            'class_id' => 'required',
            'code' => 'required',
        ];
        return $this->StoreData($request,$this->model, $rules);
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
        $rules = [
            'name' => 'required',
            'class_id' => 'required',
            'code' => 'required',
        ];
        return $this->dataUpdate($request,$this->model, $rules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteData($this->model,$id);
    }
}
