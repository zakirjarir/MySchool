<?php

namespace App\Http\Controllers\Academic;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Academic\ClassRoom;
use Illuminate\Http\Request;
use function App\Helper\returnData;

class ClassRoomController extends Controller
{
    use Helper;
    use TraitSupport;

    public function __construct(){
        $this->model =  new ClassRoom();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $data = $this->model->when($keyword,function ($query) use ($keyword){
            $query->where('name','like','%'.$keyword.'%');
            $query->orWhere('room_number','like','%'.$keyword.'%');
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
       $rules = [
           'name'=>'required',
           'room_number'=>'required|unique:class_rooms,room_number',
           'seats'=>'nullable',
       ];
       return $this->StoreData($request, $this->model, $rules);
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
            'name'=>'required',
            'room_number'=>'required',
            'seats'=>'nullable',
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
