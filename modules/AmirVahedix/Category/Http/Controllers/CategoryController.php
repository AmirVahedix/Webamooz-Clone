<?php


namespace AmirVahedix\Category\Http\Controllers;


use AmirVahedix\Category\Http\Requests\CreateCategoryRequest;
use AmirVahedix\Category\Http\Requests\UpdateCategoryRequest;
use AmirVahedix\Category\Models\Category;
use AmirVahedix\Category\Repositories\CategoryRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->all('desc');
        return view('Category::index', [
            'categories' => $categories
        ]);
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $this->categoryRepo->create($request);

        toast('دسته‌بندی باموفقیت ایجاد شد.', 'success');
        return back();
    }

    public function edit(Category $category)
    {
        $categories = $this->categoryRepo->all('asc');
        return view('Category::edit', compact('category', 'categories'));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->categoryRepo->update($category, $request);
        toast('تغییرات باموفقیت ذخیره شد.', 'success');
        return redirect(route('admin.categories.index'));
    }

    public function delete(Category $category): RedirectResponse
    {
        $this->categoryRepo->delete($category);

        toast('دسته‌بندی باموفقیت حذف شد.', 'success');
        return back();
    }
}
