<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Services\FaqService;

class AdminFaqController extends Controller
{
    protected FaqService $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $faqs = $this->faqService->getFaqs();
        $responseData = [
            'faqs' => $faqs
        ];
        return view('admin.faq.index', $responseData);
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(StoreFaqRequest $request)
    {
        $validatedData = $request->validated();
        $faq = $this->faqService->create($validatedData);
        $status = $faq ? 'success' : 'error';
        $message = $faq ? 'Faq section is created successfully' : 'Faq could not be created successfully';
        return redirect()->route('admin.faqs.index')->with($status, $message);
    }

    public function edit(Faq $faq)
    {
        $responseData = [
            'faq' => $faq
        ];
        return view('admin.faq.create', $responseData);
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $validatedData = $request->validated();
        $isUpdated = $faq->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Faq section is updated successfully' : 'Faq could not be updated successfully';
        return redirect()->route('admin.faqs.index')->with($status, $message);
    }

    public function destroy(Faq $faq)
    {
        $isDeleted = $faq->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Faq section is deleted successfully' : 'Faq could not be deleted successfully';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Faq $faq)
    {
        $faq->is_active = $request->is_active ? false : true;
        $isUpdated = $faq->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Faq section\'s status is updated successfully' : 'Faq section\'s status could not be updated successfully';
        return redirect()->route('admin.faqs.index')->with($status, $message);
    }
}
