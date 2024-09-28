<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\Category\StoreAboutCategoryRequest;
use App\Http\Requests\About\Category\UpdateAboutCategoryRequest;
use Illuminate\Http\Request;
use App\Models\AboutCategory;
use App\Services\About\AboutCategoryService;

class AdminAboutCategoryController extends Controller
{
    protected AboutCategoryService $aboutCategoryService;

    public function __construct(AboutCategoryService $aboutCategoryService)
    {
        $this->aboutCategoryService = $aboutCategoryService;
    }

    public function index()
    {
        $aboutCategoryCategories = $this->aboutCategoryService->getAboutCategories();
        $responseData = [
            'aboutCategories' => $aboutCategoryCategories
        ];
        return view('admin.about.category.index', $responseData);
    }

    public function create()
    {
        return view('admin.about.category.create');
    }

    public function store(StoreAboutCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $aboutCategory = $this->aboutCategoryService->create($validatedData);
        $status = $aboutCategory ? 'success' : 'error';
        $message = $aboutCategory ? 'About section\'s category is created successfully' : 'About section\'s category could not be created successfully';
        return redirect()->route('admin.about-category.index')->with($status, $message);
    }

    public function edit(AboutCategory $aboutCategory)
    {
        $responseData = [
            'aboutCategory' => $aboutCategory
        ];
        return view('admin.about.category.create', $responseData);
    }

    public function update(UpdateAboutCategoryRequest $request, AboutCategory $aboutCategory)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $isUpdated = $aboutCategory->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'About section\'s category is updated successfully' : 'About section\'s category could not be updated successfully';
        return redirect()->route('admin.about-category.index')->with($status, $message);
    }

    public function destroy(AboutCategory $aboutCategory)
    {
        $isDeleted = $this->aboutCategoryService->deleteAboutCategory($aboutCategory);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'About section\'s category is deleted successfully' : 'About section\'s category could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, AboutCategory $aboutCategory)
    {
        $aboutCategory->is_active = $request->is_active ? false : true;
        $isUpdated = $aboutCategory->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'About section\'s category status is updated successfully' : 'About section\'s category status could not be updated successfully';
        return redirect()->route('admin.about-category.index')->with($status, $message);
    }
}
