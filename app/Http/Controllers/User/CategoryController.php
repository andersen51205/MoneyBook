<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'type' => 'required|numeric',
            'icon' => 'required|numeric',
            'color' => 'required|numeric',
            'name' => 'required|string|max:255',
            'hidden' => 'nullable|boolean',
        ]);
        // Format data
        $data = [];
        $data['user_id'] = Auth::user()->id;
        $data['type'] = $request['type'];
        $data['icon'] = $request['icon'];
        $data['color'] = $request['color'];
        $data['name'] = $request['name'];
        $data['sort'] = 0;
        $data['hidden'] = !!$request['hidden'];
        // Create
        $categoryId = Category::create($data)->id;
        // Response
        $category = Category::where('id', $categoryId)
                            ->first();
        return response()->json([
            'message' => '新增成功',
            'category' => $category,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
