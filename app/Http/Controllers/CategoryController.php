<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($attributes)
    {
        $category = new Category($attributes);

        return $category;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'description' => 'required|max:150',
            'name' => 'required|max:150',
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        return $this->create($data)->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'description' => 'max:150',
            'name' => 'max:150',
        ]);

        if ($validator->fails()) {
            return Response($validator->errors(), 422);
        }
        $category =  Category::findOrFail($categoryId);

        $category->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoryId)
    {
        $category = Category::where('id', $categoryId)->firstOrFail();
        $category->delete();
        return Response($category, 200);
    }
}
