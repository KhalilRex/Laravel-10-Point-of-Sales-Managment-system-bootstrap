<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate(5);
        return view('category.index', compact('category')); 
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
        $category = new Category;
        $category->Title = $request->input('Title');
        $category->description = $request->input('description');
            // check if an image file was uploaded
        if ($request->hasFile('image')) {
            // get the uploaded file and store it in the public folder
            $image = $request->file('image');
            $path = public_path() . '/uploads/categories/';
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            // save the file name in the database
            $category->image = $filename;
        }
        $category->save();

        if($category){
            return redirect()->route('category.index')->with('success', 'User created successfully');
        }
        return redirect()->back()->with('error', 'Failed to create user'); 
     //   dd($request->all());
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
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('category.index')->with('success', 'category updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'User not found');
        }
           $category->delete($request->all());
           return redirect()->route('category.index')->with('success', 'category updated successfully');
    }
}
