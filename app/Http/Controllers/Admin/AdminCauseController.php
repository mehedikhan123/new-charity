<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cause\StoreCausePhotoRequest;
use App\Http\Requests\Cause\StoreCauseRequest;
use App\Http\Requests\Cause\StoreCauseVideoRequest;
use App\Http\Requests\Cause\UpdateCausePhotoRequest;
use App\Http\Requests\Cause\UpdateCauseRequest;
use App\Http\Requests\Cause\UpdateCauseVideoRequest;
use App\Models\Cause;
use App\Models\CauseDonation;
use App\Models\CauseFaq;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Services\CauseDonationService;
use App\Services\CausePhotoService;
use App\Services\CauseService;
use App\Services\CauseVideoService;
use App\Services\Core\HelperService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminCauseController extends Controller
{
    protected CauseService $causeService;
    protected CauseDonationService $causeDonationService;
    protected UserService $userService;
    protected CausePhotoService $causePhotoService;
    protected CauseVideoService $causeVideoService;

    public function __construct(CauseService $causeService, CauseDonationService $causeDonationService, UserService $userService, CausePhotoService $causePhotoService, CauseVideoService $causeVideoService)
    {
        $this->causeService = $causeService;
        $this->causeDonationService = $causeDonationService;
        $this->userService = $userService;
        $this->causePhotoService = $causePhotoService;
        $this->causeVideoService = $causeVideoService;
    }

    public function index()
    {
        $causes = $this->causeService->getCauses();
        $responseData = [
            'causes' => $causes
        ];
        return view('admin.cause.index', $responseData);
    }

    public function create()
    {
        return view('admin.cause.create');
    }

    public function store(StoreCauseRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $validatedData['raised'] = 0;
        $validatedData['featured_photo'] = HelperService::uploadPhoto(request()->file('featured_photo'), 'cause_featured_photo');
        $cause = $this->causeService->create($validatedData);
        $status = $cause ? 'success' : 'error';
        $message = $cause ? 'Cause section is created successfully' : 'Cause section could not be created successfully';
        return redirect()->route('admin.causes.index')->with($status, $message);
    }

    public function edit(cause $cause)
    {
        $responseData = [
            'cause' => $cause
        ];
        return view('admin.cause.create', $responseData);
    }

    public function update(UpdateCauseRequest $request, cause $cause)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        if($request->hasFile('featured_photo')) {
            $validatedData['featured_photo'] = HelperService::uploadPhoto(request()->file('featured_photo'), 'cause_featured_photo', $cause->photo);
        }
        $isUpdated = $cause->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Cause section is updated successfully' : 'Cause section could not be updated successfully';
        return redirect()->route('admin.causes.index')->with($status, $message);
    }

    public function destroy(Cause $cause)
    {
        if(isset($cause) && isset($cause->photo)) {
            unlink(public_path('storage/uploads/photo/'. $cause->photo));
        }
        $isDeleted = $cause->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Cause section is deleted successfully' : 'Cause section could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    // public function changeStatus(Request $request, Cause $cause)
    // {
    //     $cause->is_active = $request->is_active ? false : true;
    //     $isUpdated = $cause->save();
    //     $status = $isUpdated ? 'success' : 'error';
    //     $message = $isUpdated ? 'Cause status is updated successfully' : 'Cause status could not be updated successfully';
    //     return redirect()->route('admin.causes.index')->with($status, $message);
    // }

    public function faq($id)
    {
        $cause_single = Cause::findOrFail($id);
        $cause_faqs = CauseFaq::where('cause_id', $id)->get();
        return view('admin.cause.faq', compact('cause_single', 'cause_faqs'));
    }

    public function faq_submit(Request $request)
    {
        $request->validate([
            'cause_id' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        $obj = new CauseFaq();
        $obj->cause_id = $request->cause_id;
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->save();

        return redirect()->back()->with('success','Cause FAQ created successfully');
    }

    public function faq_delete($id)
    {
        $cause_faq = CauseFaq::findOrFail($id);
        $cause_faq->delete();

        return redirect()->back()->with('success','Cause FAQ deleted successfully');
    }

    public function faq_update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $obj = CauseFaq::findOrFail($id);
        $obj->question = $request->question;
        $obj->answer = $request->answer;
        $obj->update();

        return redirect()->back()->with('success','Cause FAQ updated successfully');
    }

    public function donations(Cause $cause = null)
    {
        if($cause) {
            $causeDonations = $this->causeDonationService->getCauseDonations($cause);
        } else {
            $causeDonations = $this->causeDonationService->getAllDonations();
        }
        $responseData = [
            'cause' => $cause,
            'causeDonations' => $causeDonations
        ];
        return view('admin.cause.donations', $responseData);
    }

    public function donationInvoice(Cause $cause = null, CauseDonation $causeDonation)
    {
        if($cause) {
            $donationData = $this->causeDonationService->getCauseDonation($cause, $causeDonation);
        } else {
            $donationData = $this->causeDonationService->getDonation($causeDonation);
        }
        $userData = $this->userService->getUser($donationData->user_id);
        $responseData = [
            'donationData' => $donationData,
            'userData' => $userData
        ];
        return view('admin.cause.invoice', $responseData);
    }

    public function photos(Cause $cause, CausePhoto $causePhoto = null)
    {
        $causePhotos = $this->causePhotoService->getCausePhotos($cause);
        $responseData = [
            'causePhotos' => $causePhotos,
            'causePhoto' => $causePhoto,
            'cause' => $cause
        ];
        return view('admin.cause.photo', $responseData);
    }

    public function storePhotos(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['photo'] = HelperService::uploadPhotos(request()->file('photo'), 'cause_photo');
        $causePhoto = $this->causePhotoService->createPhotos($validatedData);
        $status = $causePhoto ? 'success' : 'error';
        $message = $causePhoto ? 'Cause\'s photo created successfully' : 'Cause\'s photo could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updatePhoto(UpdateCausePhotoRequest $request, Cause $cause, CausePhoto $causePhoto)
    {
        $validatedData['cause_id'] = $request->cause_id;
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'cause_photo', $causePhoto->photo);
        }
        if($cause) {
            $causePhoto = $causePhoto->update($validatedData);
        } else {
            $causePhoto = null;
        }
        $status = $causePhoto ? 'success' : 'error';
        $message = $causePhoto ? 'Cause\'s photo updated successfully' : 'Cause\'s photo could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyPhoto(Cause $cause, CausePhoto $causePhoto)
    {
        $isDeleted = $this->causePhotoService->deleteCausePhoto($cause, $causePhoto);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Cause\'s photo section is deleted successfully' : 'Cause\'s photo could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function videos(Cause $cause, CauseVideo $causeVideo = null)
    {
        $causeVideos = $this->causeVideoService->getCauseVideos($cause);
        $responseData = [
            'causeVideos' => $causeVideos,
            'causeVideo' => $causeVideo,
            'cause' => $cause
        ];
        return view('admin.cause.video', $responseData);
    }

    public function storeVideos(Request $request)
    {
        $validatedData['cause_id'] = $request->cause_id;
        $validatedData['video'] = $request->video;
        $causeVideo = $this->causeVideoService->createVideos($validatedData);
        $status = $causeVideo ? 'success' : 'error';
        $message = $causeVideo ? 'Cause\'s video created successfully' : 'Cause\'s video could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updateVideo(UpdateCauseVideoRequest $request, Cause $cause, CauseVideo $causeVideo)
    {
        $validatedData['cause_id'] = $request->cause_id;
        $validatedData['video'] = $request->video;
        if($cause) {
            $causeVideo = $causeVideo->update($validatedData);
        } else {
            $causeVideo = null;
        }
        $status = $causeVideo ? 'success' : 'error';
        $message = $causeVideo ? 'Cause\'s video updated successfully' : 'Cause\'s video could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyVideo(Cause $cause, CauseVideo $causeVideo)
    {
        $isDeleted = $this->causeVideoService->deleteCauseVideo($cause, $causeVideo);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Cause\'s video section is deleted successfully' : 'Cause\'s video could not be deleted';
        return redirect()->back()->with($status, $message);
    }
}
