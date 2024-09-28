<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use App\Services\Core\HelperService;
use App\Services\SliderService;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    protected SliderService $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    public function index()
    {
        $sliders = $this->sliderService->getSliders();
        $responseData = [
            'sliders' => $sliders
        ];
        return view('admin.slider.index', $responseData);
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'slider_photo');
        $slider = $this->sliderService->create($validatedData);
        $status = $slider ? 'success' : 'error';
        $message = $slider ? 'Slider section is created successfully' : 'Slider section could not be created successfully';
        return redirect()->route('admin.sliders.index')->with($status, $message);
    }

    public function edit(Slider $slider)
    {
        $responseData = [
            'slider' => $slider
        ];
        return view('admin.slider.create', $responseData);
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'slider_photo', $slider->photo);
        }
        $isUpdated = $slider->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Slider section is updated successfully' : 'Slider section could not be updated successfully';
        return redirect()->route('admin.sliders.index')->with($status, $message);
    }

    public function destroy(Slider $slider)
    {
        if(isset($slider->photo)) {
            $file_path = public_path('storage/uploads/photo/'. $slider->photo);
            if(file_exists($file_path))
                unlink($file_path);
        }
        $isDeleted = $slider->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Slider section is deleted successfully' : 'Slider section could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Slider $slider)
    {
        $slider->is_active = $request->is_active ? false : true;
        $isUpdated = $slider->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Slider section\'s status is updated successfully' : 'Slider section\'s status could not be updated successfully';
        return redirect()->route('admin.sliders.index')->with($status, $message);
    }
}
