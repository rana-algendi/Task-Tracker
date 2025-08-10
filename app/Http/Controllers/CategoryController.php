<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = auth()->user()->categories; // get only this user's categories
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {  //في حالة اني هعمل validationمباشرة في ال الكونتروللر
        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);

        // auth()->user()->categories()->create($request->only('name'));
        $data = $request->validated();
        $request->user()->categories()->create($data);

        return redirect()->route('categories.index')->with('success', 'Category created.');
        //-----------------------------------------------
        //في حاله اني هعمل validation عن طريق request class

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
        $category = auth()->user()->categories()->findOrFail($id);
        $this->authorize('update', $category); // Check user ownership
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category); // ← this checks the policy

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = auth()->user()->categories()->findOrFail($id);
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');

    }
}
