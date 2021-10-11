<?php


namespace AmirVahedix\Category\Http\Controllers;


use AmirVahedix\Category\Http\Requests\CreateCategoryRequest;
use AmirVahedix\Category\Http\Requests\UpdateCategoryRequest;
use AmirVahedix\Category\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Category::index', [
            'categories' => $categories
        ]);
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return back();
    }

    public function edit(Category $category)
    {
        $categories = Category::latest()->get();
        return view('Category::edit', compact('category', 'categories'));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $category->update($request->validated());

        return redirect(route('admin.categories.index'));
    }

    public function delete(Category $category): RedirectResponse
    {
        $category->delete();

        return back();
    }
}
