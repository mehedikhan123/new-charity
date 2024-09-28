<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Volunteer\StoreVolunteerRequest;
use App\Models\Volunteer;
use App\Services\Core\HelperService;
use App\Services\CountryService;
use App\Services\VolunteerService;

class VolunteerController extends Controller
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
        $volunteers = $this->volunteerService->getActiveVolunteers();
        $validatedData = [
            'volunteers' => $volunteers
        ];
        return view('front.volunteer.index', $validatedData);
    }

    public function create()
    {
        $nameTitles = HelperService::getNameTitles();
        $countries = $this->countryService->getCountries();
        $responseData = [
            'nameTitles' => $nameTitles,
            'countries' => $countries
        ];
        return view('front.volunteer.create', $responseData);
    }

    public function store(StoreVolunteerRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['is_active'] = false;
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'volunteer_photo');
        $volunteer = $this->volunteerService->create($validatedData);
        $status = $volunteer ? 'success' : 'error';
        $message = $volunteer ? 'Your request is submitted successfully' : 'Your request could not be submitted successfully';
        return redirect()->route('home')->with($status, $message);
    }

    public function show(Volunteer $volunteer)
    {
        $validatedData = [
            'volunteer' => $volunteer
        ];
        return view('front.volunteer.show', $validatedData);
    }
}
