<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orphan\StoreOrphanRequest;
use App\Http\Requests\Orphan\UpdateOrphanRequest;
use App\Models\Cause;
use App\Models\Orphan;
use App\Models\Volunteer;
use App\Services\Core\HelperService;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminOrphanController extends Controller
{
    public function index()
    {
        $orphans = Orphan::with('volunteer', 'upazilaName', 'districtName', 'divisionName')->get();
        return view('admin.orphan.index', compact('orphans'));
    }

    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $volunteers = Volunteer::all();

        $responseData = [
            'upazilas' => $upazilas,
            'districts' => $districts,
            'divisions' => $divisions,
            'volunteers' => $volunteers
        ];
        return view('admin.orphan.create', $responseData);
    }

    public function store(StoreOrphanRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'orphan_photo');
        $orphan = Orphan::create($validatedData);
        $status = $orphan ? 'success' : 'error';
        $message = $orphan ? 'Orphan is created successfully' : 'Orphan could not be created successfully';
        return redirect()->route('admin.orphans.index')->with($status, $message);
    }

    public function edit(Orphan $orphan)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $volunteers = Volunteer::all();

        $responseData = [
            'orphan' => $orphan,
            'upazilas' => $upazilas,
            'districts' => $districts,
            'divisions' => $divisions,
            'volunteers' => $volunteers
        ];
        return view('admin.orphan.create', $responseData);
    }

    public function update(UpdateOrphanRequest $request, Orphan $orphan)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'orphan_photo', $orphan);
        }
        $isUpdated = $orphan->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Orphan is updated successfully' : 'Orphan could not be updated successfully';
        return redirect()->route('admin.orphans.index')->with($status, $message);
    }

    public function changeStatus(Request $request, Orphan $orphan)
    {
        $isUpdated = $orphan->update($request->all());
        if($orphan->status === 'approved') {
            Cause::create(
            [
                'orphan_id' => $orphan->id,
                'name' => $orphan->name,
                'slug' => Str::slug($orphan->name),
                'goal' => 100,
                'raised' => 0,
                'featured_photo' => $orphan->photo,
                'is_featured' => 'Yes'
            ]);
        } 
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Orphan\'s status is updated successfully' : 'Orphan\'s status could not be updated successfully';
        return redirect()->route('admin.orphans.index')->with($status, $message);
    }

    public function destroy(Orphan $orphan)
    {
        if(isset($orphan->photo)) {
            $file_path = public_path('storage/uploads/photo/'.$orphan->photo);
            if(file_exists($file_path))
            unlink($file_path);
        }
        $isDeleted = $orphan->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Orphan is deleted successfully' : 'Orphan could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }
}
