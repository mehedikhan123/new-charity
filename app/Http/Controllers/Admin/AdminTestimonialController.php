<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Services\Core\HelperService;
use App\Services\TestimonialService;

class AdminTestimonialController extends Controller
{
    protected TestimonialService $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = $this->testimonialService->getTestimonials();
        $responseData = [
            'testimonials' => $testimonials
        ];
        return view('admin.testimonial.index', $responseData);
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(StoreTestimonialRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'testimonial_photo');
        $testimonial = $this->testimonialService->create($validatedData);
        $status = $testimonial ? 'success' : 'error';
        $message = $testimonial ? 'Testimonial is created successfully' : 'Testimonial could not be created';
        return redirect()->route('admin.testimonials.index')->with($status, $message);
    }

    public function edit(Testimonial $testimonial)
    {
        $responseData = [
            'testimonial' => $testimonial
        ];
        return view('admin.testimonial.create', $responseData);
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'testimonial_photo', $testimonial->photo);
        }
        $isUpdated = $testimonial->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Testimonial is updated successfully' : 'Testimonial could not be updated';
        return redirect()->route('admin.testimonials.index')->with($status, $message);
    }

    public function destroy(Testimonial $testimonial)
    {
        if(isset($testimonial) && isset($testimonial->photo)) {
            unlink(public_path('storage/uploads/photo/'. $testimonial->photo));
        }
        $isDeleted = $testimonial->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Testimonial is deleted successfully' : 'Testimonial could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Testimonial $testimonial)
    {
        $testimonial->is_active = $request->is_active ? false : true;
        $isUpdated = $testimonial->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Testimonial status is updated successfully' : 'Testimonial status could not be updated successfully';
        return redirect()->route('admin.testimonials.index')->with($status, $message);
    }
}
