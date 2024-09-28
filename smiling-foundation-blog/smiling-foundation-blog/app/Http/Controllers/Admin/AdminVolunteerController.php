<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\StoreVolunteerRequest;
use App\Http\Requests\Volunteer\UpdateVolunteerRequest;
use App\Services\Core\HelperService;
use App\Models\Volunteer;
use App\Services\CountryService;
use App\Services\VolunteerService;
use Illuminate\Http\Request;

class AdminVolunteerController extends Controller
{
    protected VolunteerService $volunteerService;
    protected CountryService $countryService;

    public function __construct(VolunteerService $volunteerService, CountryService $countryService)
    {
        $this->volunteerService = $volunteerService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $volunteers = $this->volunteerService->getVolunteers();
        $responseData = [
            'volunteers' => $volunteers
        ];
        return view('admin.volunteer.index', $responseData);
    }

    public function create()
    {
        $nameTitles = HelperService::getNameTitles();
        $countries = $this->countryService->getCountries();
        $responseData = [
            'nameTitles' => $nameTitles,
            'countries' => $countries
        ];
        return view('admin.volunteer.create', $responseData);
    }

    public function store(StoreVolunteerRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'volunteer_photo');
        $volunteer = $this->volunteerService->create($validatedData);
        $status = $volunteer ? 'success' : 'error';
        $message = $volunteer ? 'Volunteer is created successfully' : 'Volunteer could not be created successfully';
        return redirect()->route('admin.volunteers.index')->with($status, $message);
    }

    public function edit(Volunteer $volunteer)
    {
        $nameTitles = HelperService::getNameTitles();
        $countries = $this->countryService->getCountries();
        $responseData = [
            'volunteer' => $volunteer,
            'nameTitles' => $nameTitles,
            'countries' => $countries
        ];
        return view('admin.volunteer.create', $responseData);
    }

    public function update(UpdateVolunteerRequest $request, Volunteer $volunteer)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'volunteer_photo', $volunteer);
        }
        $isUpdated = $volunteer->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Volunteer is updated successfully' : 'Volunteer could not be updated successfully';
        return redirect()->route('admin.volunteers.index')->with($status, $message);
    }

    public function destroy(Volunteer $volunteer)
    {
        if(isset($volunteer->photo)) {
            $file_path = public_path('storage/uploads/photo/'.$volunteer->photo);
            if(file_exists($file_path))
            unlink($file_path);
        }
        $isDeleted = $volunteer->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Volunteer is deleted successfully' : 'Volunteer could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Volunteer $volunteer)
    {
        $volunteer->is_active = $request->is_active ? false : true;
        $isUpdated = $volunteer->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Volunteer status is updated successfully' : 'Volunteer status could not be updated successfully';
        return redirect()->route('admin.volunteers.index')->with($status, $message);
    }
}
