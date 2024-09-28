<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Facility\StoreFacilityRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Models\Facility;
use App\Services\FacilityService;
use Illuminate\Http\Request;

class AdminFacilityController extends Controller
{
    protected FacilityService $facilityService;

    public function __construct(FacilityService $facilityService)
    {
        $this->facilityService = $facilityService;
    }

    public function index()
    {
        $facilities = $this->facilityService->getfacilities();
        $responseData = [
            'facilities' => $facilities
        ];
        return view('admin.facility.index', $responseData);
    }

    public function create()
    {
        return view('admin.facility.create');
    }

    public function store(StoreFacilityRequest $request)
    {
        $validatedData = $request->validated();
        $facility = $this->facilityService->create($validatedData);
        $status = $facility ? 'success' : 'error';
        $message = $facility ? 'Service section is created successfully' : 'Service section could not be created successfully';
        return redirect()->route('admin.facilities.index')->with($status, $message);
    }

    public function edit(Facility $facility)
    {
        $responseData = [
            'facility' => $facility
        ];
        return view('admin.facility.create', $responseData);
    }

    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $validatedData = $request->validated();
        $isUpdated = $facility->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Service section is updated successfully' : 'Service section could not be updated successfully';
        return redirect()->route('admin.facilities.index')->with($status, $message);
    }

    public function destroy(Facility $facility)
    {
        $isDeleted = $facility->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Service section is deleted successfully' : 'Service section could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Facility $facility)
    {
        $facility->is_active = $request->is_active ? false : true;
        $isUpdated = $facility->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Service section\'s status is updated successfully' : 'Service section\'s status could not be updated successfully';
        return redirect()->route('admin.facilities.index')->with($status, $message);
    }
}
