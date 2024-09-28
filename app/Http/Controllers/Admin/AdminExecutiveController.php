<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Executive\StoreExecutiveRequest;
use App\Http\Requests\Executive\UpdateExecutiveRequest;
use App\Services\Core\HelperService;
use App\Models\Executive;
use App\Services\CountryService;
use App\Services\ExecutiveService;
use Illuminate\Http\Request;

class AdminExecutiveController extends Controller
{
    protected ExecutiveService $executiveService;
    protected CountryService $countryService;

    public function __construct(ExecutiveService $executiveService, CountryService $countryService)
    {
        $this->executiveService = $executiveService;
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $executives = $this->executiveService->getExecutives();
        $responseData = [
            'executives' => $executives
        ];
        return view('admin.executive.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = $this->countryService->getCountries();
        $responseData = [
            'countries' => $countries
        ];
        return view('admin.executive.create', $responseData);
    }

    public function store(StoreExecutiveRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'executive_photo');
        $executive = $this->executiveService->create($validatedData);
        $status = $executive ? 'success' : 'error';
        $message = $executive ? 'Executive is created successfully' : 'Executive could not be created';
        return redirect()->route('admin.executives.index')->with($status, $message);
    }

    public function edit(Executive $executive)
    {
        $countries = $this->countryService->getCountries();
        $responseData = [
            'executive' => $executive,
            'countries' => $countries
        ];
        return view('admin.executive.create', $responseData);
    }

    public function update(UpdateExecutiveRequest $request, Executive $executive)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'executive_photo', $executive);
        }
        $isUpdated = $this->executiveService->update($executive, $validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Executive is updated successfully' : 'Executive could not be updated';
        return redirect()->route('admin.executives.index')->with($status, $message);
    }

    public function destroy(Executive $executive)
    {
        if(isset($executive) && isset($executive->photo)) {
            unlink(public_path('storage/uploads/photo/'. $executive->photo));
        }
        $isDeleted = $executive->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Executive is deleted successfully' : 'Executive could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Executive $executive)
    {
        $executive->is_active = $request->is_active ? false : true;
        $isUpdated = $executive->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Executive\'s status is updated successfully' : 'Executive\'s status could not be updated successfully';
        return redirect()->route('admin.executives.index')->with($status, $message);
    }
}
