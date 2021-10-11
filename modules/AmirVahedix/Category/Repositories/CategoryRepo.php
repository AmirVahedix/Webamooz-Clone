<?php


namespace AmirVahedix\Category\Repositories;


use AmirVahedix\Category\Models\Category;

class CategoryRepo
{
    public function all($order)
    {
        return Category::orderBy('created_at', $order)->get();
    }

    public function create($request)
    {
        return Category::create($request->validated());
    }

    public function update($category, $request)
    {
        $category->update($request->validated());
    }

    public function delete($category)
    {
        $category->delete();
    }
}
