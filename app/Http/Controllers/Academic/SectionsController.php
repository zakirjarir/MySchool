<?php

namespace App\Http\Controllers\Academic;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class SectionsController extends Controller
{
    use Helper;
    Use TraitSupport;
    public function __construct(){
        $this->model = new Sections();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = $this->model->when($keyword,function ($query) use ($keyword){
            $query->where('name','like','%'.$keyword.'%');
        }) ->paginate($request->input('par_page'));;
        return returnData('2000',$data,'success','success');
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
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:classes,id', // প্রতিটি class_id ডাটাবেজে থাকতে হবে
        ]);

        if ($validated->fails()) {
            return returnData('5001','Validation error',$validated->errors(),'error');
        }

        foreach ($request->class_ids as $class_id) {
            $this->model->create([
                'name' => $request->name,
                'class_id' => $class_id,
            ]);
        }
        return returnData('2000','Created Successfully','Section Created Successfully','success');
    }


    /**
     * Display the specified resource.
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sections $sections)
    {
        $rules = [
            'name'=>'required',
            'class_id'=>'required',
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
