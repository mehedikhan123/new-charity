<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\StoreAboutRequest;
use App\Http\Requests\About\UpdateAboutRequest;
use App\Models\About;
use App\Models\AboutCategory;
use App\Services\About\AboutCategoryService;
use App\Services\Core\HelperService;
use App\Services\About\AboutService;
use Illuminate\Http\Request;

class AdminAboutController extends Controller
{
    protected AboutService $aboutService;
    protected AboutCategoryService $aboutCategoryService;

    public function __construct(AboutService $aboutService, AboutCategoryService $aboutCategoryService)
    {
        $this->aboutService = $aboutService;
        $this->aboutCategoryService = $aboutCategoryService;
    }

    public function index()
    {
        $aboutSections = $this->aboutService->getAboutSections();
        $responseData = [
            'aboutSections' => $aboutSections
        ];
        return view('admin.about.index', $responseData);
    }

    public function create()
    {
        $categories = $this->aboutCategoryService->getActiveAboutCategories();
        $responseData = [
            'categories' => $categories
        ];
        return view('admin.about.create', $responseData);
    }

    public function store(StoreAboutRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'about_photo');
        $about = $this->aboutService->create($validatedData);
        $status = $about ? 'success' : 'error';
        $message = $about ? 'About section is created successfully' : 'About section could not be created successfully';
        return redirect()->route('admin.about.index')->with($status, $message);
    }

    public function edit(About $about)
    {
        $categories = $this->aboutCategoryService->getActiveAboutCategories();
        $responseData = [
            'about' => $about,
            'categories' => $categories
        ];
        return view('admin.about.create', $responseData);
    }

    public function update(UpdateAboutRequest $request, About $about)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'about_photo', $about->photo);
        }
        $isUpdated = $about->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'About section is updated successfully' : 'About section could not be updated successfully';
        return redirect()->route('admin.about.index')->with($status, $message);
    }

    public function destroy(About $about)
    {
        if(isset($about) && isset($about->photo)) {
            unlink(public_path('storage/uploads/photo/'. $about->photo));
        }
        $isDeleted = $about->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'About section is deleted successfully' : 'About section could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, About $about)
    {
        $about->is_active = $request->is_active ? false : true;
        $isUpdated = $about->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'About status is updated successfully' : 'About status could not be updated successfully';
        return redirect()->route('admin.about.index')->with($status, $message);
    }
}
