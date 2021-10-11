<?php


namespace AmirVahedix\Category\Http\Controllers;


use AmirVahedix\Category\Http\Requests\CreateCategoryRequest;
use AmirVahedix\Category\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('Category::index', [
            'categories' => $categories
        ]);
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->validated());

        return back();
    }
}
