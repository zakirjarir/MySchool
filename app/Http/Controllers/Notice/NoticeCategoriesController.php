<?php

namespace App\Http\Controllers\Notice;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Notice\NoticeCategories;
use Illuminate\Http\Request;
use function App\Helper\returnData;

class NoticeCategoriesController extends Controller
{
    use Helper;
    use TraitSupport;

    public function __construct(){
        $this->model = new NoticeCategories();
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
        $rules = [
            'name' => 'required',
        ];
        return $this->StoreData($request,new NoticeCategories(),$rules);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        return $this->dataUpdate($request,new NoticeCategories(), $rules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteData($this->model,$id);
    }
}
