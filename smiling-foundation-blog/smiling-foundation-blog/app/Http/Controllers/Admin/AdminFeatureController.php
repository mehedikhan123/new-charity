<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feature\StoreFeatureRequest;
use App\Http\Requests\Feature\UpdateFeatureRequest;
use App\Models\Feature;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class AdminFeatureController extends Controller
{
    protected FeatureService $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->featureService = $featureService;
    }

    public function index()
    {
        $features = $this->featureService->getfeatures();
        $responseData = [
            'features' => $features
        ];
        return view('admin.feature.index', $responseData);
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function store(StoreFeatureRequest $request)
    {
        $validatedData = $request->validated();
        $feature = $this->featureService->create($validatedData);
        $status = $feature ? 'success' : 'error';
        $message = $feature ? 'Feature section is created successfully' : 'Feature section could not be created successfully';
        return redirect()->route('admin.features.index')->with($status, $message);
    }

    public function edit(Feature $feature)
    {
        $responseData = [
            'feature' => $feature
        ];
        return view('admin.feature.create', $responseData);
    }

    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $validatedData = $request->validated();
        $isUpdated = $feature->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Feature section is updated successfully' : 'Feature section could not be updated successfully';
        return redirect()->route('admin.features.index')->with($status, $message);
    }

    public function destroy(Feature $feature)
    {
        $isDeleted = $feature->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Feature section is deleted successfully' : 'Feature section could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Feature $feature)
    {
        $feature->is_active = $request->is_active ? false : true;
        $isUpdated = $feature->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Feature section\'s status is updated successfully' : 'Feature section\'s status could not be updated successfully';
        return redirect()->route('admin.features.index')->with($status, $message);
    }
}
