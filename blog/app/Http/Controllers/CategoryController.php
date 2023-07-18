<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category = new Category();

        $category->title = $request->title;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Has Created Successfully.');
        //return redirect()->back()->with('success', 'Category created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'title' => 'required|max:255',
        ]);

        $category->title = $request->title;

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back();
    }
}
