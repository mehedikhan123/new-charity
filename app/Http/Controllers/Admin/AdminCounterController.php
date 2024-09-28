<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Counter\UpdateCounterRequest;
use App\Models\Counter;
use App\Services\CounterService;

class AdminCounterController extends Controller
{
    protected CounterService $counterService;

    public function __construct(CounterService $counterService)
    {
        $this->counterService = $counterService;
    }

    public function index()
    {
        $counter = $this->counterService->getCounter();
        $responseData = [
            'counter' => $counter
        ];
        return view('admin.counter.index', $responseData);
    }

    public function update(UpdateCounterRequest $request, Counter $counter = null)
    {
        $validatedData = $request->validated();
        if(!$counter) {
            $counter = $this->counterService->create($validatedData);
            $status = $counter ? 'success' : 'error';
            $message = $counter ? 'Counter section is created successfully' : 'Counter section could not be created successfully';
        } else {
            $isUpdated = $counter->update($validatedData);
            $status = $isUpdated ? 'success' : 'error';
            $message = $isUpdated ? 'Counter section is updated successfully' : 'Counter section could not be updated successfully';
        }
        return redirect()->route('admin.counters.index')->with($status, $message);
    }
}
