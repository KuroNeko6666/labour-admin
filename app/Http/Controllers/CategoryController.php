<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.category',[
            'title' => 'Labour Admin',
            'active' => 'skill-category',
            'path' => '/skill/category',
            'data' => Category::latest()->filter(request(['search']))->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.category-add',[
            'title' => 'Labour Admin',
            'active' => 'skill-category',
            'path' => '/skill/category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validate([
            'category' => 'required|max:255|unique:categories',
        ]);

        Category::create($validated);
        return redirect()->route('category')->with('message', 'kategori berhasil ditambahkan!');
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
        return view('home.category-edit',[
            'title' => 'Labour Admin',
            'active' => 'skill-category',
            'path' => '/skill/category',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->category != $category->category){
            $validated = $request->validate([
                'category' => 'required|max:255|unique:categories',
            ]);
            $category->update($validated);
        }
        return redirect()->route('category')->with('message', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $skills = $category->skill;

        foreach ($skills as $skill) {
            $skill->delete();
        }

        $category->delete();
        return redirect()->route('category')->with('message', 'Kategori berhasil dihapus!');
    }
}
