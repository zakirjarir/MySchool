<?php

namespace App\Http\Controllers\Notice;

use App\Helper\Helper;
use App\Helper\TraitSupport;
use App\Http\Controllers\Controller;
use App\Models\Notice\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function App\Helper\returnData;

class NoticeController extends Controller
{
    use Helper;
    use TraitSupport;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->model = new Notice();
    }
    public function index(Request $request)
    {
        $category = $request->category;
        $keyword = $request->keyword;
        $data = $this->model->when($category, function ($query) use ($category) {
            return $query->where('category', $category);
        })->when($keyword, function ($query) use ($keyword) {
            return $query->where('title', 'like', '%' . $keyword . '%');
        })->paginate(request('per_page', 10));
        return returnData(2000, $data, 'success', 'success');

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
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'file' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }

        // Data Insert
        $data = Notice::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category' => $request->category,
            'expiry_date' => $request->expiry_date,
            'file' => $request->file,
            'date' => now()->format('Y-m-d'), // Current Date Set
        ]);

        if ($data) {
            return returnData(2000, $data, 'Notice created successfully', 'success');
        } else {
            return returnData(5001, [], 'Failed to create notice', 'error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'file' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }

        // Data Insert
        $data = Notice::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'category' => $request->category,
            'expiry_date' => $request->expiry_date,
            'file' => $request->file,
            'date' => now()->format('Y-m-d'), // Current Date Set
        ]);

        if ($data) {
            return returnData(2000, $data, 'Notice update successfully', 'success');
        } else {
            return returnData(5001, [], 'Failed to update notice', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

}
