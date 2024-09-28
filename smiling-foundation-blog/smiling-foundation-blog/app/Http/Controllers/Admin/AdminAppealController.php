<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appeal\StoreAppealPhotoRequest;
use App\Http\Requests\Appeal\StoreAppealRequest;
use App\Http\Requests\Appeal\StoreAppealVideoRequest;
use App\Http\Requests\Appeal\UpdateAppealPhotoRequest;
use App\Http\Requests\Appeal\UpdateAppealRequest;
use App\Http\Requests\Appeal\UpdateAppealVideoRequest;
use App\Models\Appeal;
use App\Models\AppealPhoto;
use App\Models\AppealVideo;
use App\Services\AppealPhotoService;
use App\Services\Core\HelperService;
use App\Services\AppealService;
use App\Services\AppealVideoService;
use Illuminate\Http\Request;

class AdminAppealController extends Controller
{
    protected AppealService $appealService;
    protected AppealPhotoService $appealPhotoService;
    protected AppealVideoService $appealVideoService;

    public function __construct(AppealService $appealService, AppealPhotoService $appealPhotoService, AppealVideoService $appealVideoService)
    {
        $this->appealService = $appealService;
        $this->appealPhotoService = $appealPhotoService;
        $this->appealVideoService = $appealVideoService;
    }

    public function index()
    {
        $appeals = $this->appealService->getAppeals();
        $responseData = [
            'appeals' => $appeals
        ];
        return view('admin.appeal.index', $responseData);
    }

    public function create()
    {
        return view('admin.appeal.create');
    }

    public function store(StoreAppealRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'appeal_photo');
        $appeal = $this->appealService->create($validatedData);
        $status = $appeal ? 'success' : 'error';
        $message = $appeal ? 'Appeal section is created successfully' : 'Appeal section could not be created successfully';
        return redirect()->route('admin.appeals.index')->with($status, $message);
    }

    public function edit(Appeal $appeal)
    {
        $responseData = [
            'appeal' => $appeal
        ];
        return view('admin.appeal.create', $responseData);
    }

    public function update(UpdateAppealRequest $request, Appeal $appeal)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'appeal_photo', $appeal->photo);
        }
        $isUpdated = $appeal->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Appeal section is updated successfully' : 'Appeal section could not be updated successfully';
        return redirect()->route('admin.appeals.index')->with($status, $message);
    }

    public function destroy(Appeal $appeal)
    {
        if(isset($appeal) && isset($appeal->photo)) {
            unlink(public_path('storage/uploads/photo/'. $appeal->photo));
        }
        $isDeleted = $appeal->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Appeal section is deleted successfully' : 'Appeal section could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Appeal $appeal)
    {
        $appeal->is_active = $request->is_active ? false : true;
        $isUpdated = $appeal->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Appeal section\'s status is updated successfully' : 'Appeal section\'s status could not be updated successfully';
        return redirect()->route('admin.appeals.index')->with($status, $message);
    }

    public function photos(Appeal $appeal, AppealPhoto $appealPhoto = null)
    {
        $appealPhotos = $this->appealPhotoService->getAppealPhotos($appeal);
        $responseData = [
            'appealPhotos' => $appealPhotos,
            'appealPhoto' => $appealPhoto,
            'appeal' => $appeal
        ];
        return view('admin.appeal.photo', $responseData);
    }

    public function storePhotos(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['photo'] = HelperService::uploadPhotos(request()->file('photo'), 'appeal_photo');
        $appealPhoto = $this->appealPhotoService->createPhotos($validatedData);
        $status = $appealPhoto ? 'success' : 'error';
        $message = $appealPhoto ? 'Appeal\'s photo created successfully' : 'Appeal\'s photo could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updatePhoto(UpdateAppealPhotoRequest $request, Appeal $appeal, AppealPhoto $appealPhoto)
    {
        $validatedData['appeal_id'] = $request->appeal_id;
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'appeal_photo', $appealPhoto->photo);
        }
        if($appeal) {
            $appealPhoto = $appealPhoto->update($validatedData);
        } else {
            $appealPhoto = null;
        }
        $status = $appealPhoto ? 'success' : 'error';
        $message = $appealPhoto ? 'Appeal\'s photo updated successfully' : 'Appeal\'s photo could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyPhoto(Appeal $appeal, AppealPhoto $appealPhoto)
    {
        $isDeleted = $this->appealPhotoService->deleteAppealPhoto($appeal, $appealPhoto);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Appeal\'s photo section is deleted successfully' : 'Appeal\'s photo could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function videos(Appeal $appeal, AppealVideo $appealVideo = null)
    {
        $appealVideos = $this->appealVideoService->getAppealVideos($appeal);
        $responseData = [
            'appealVideos' => $appealVideos,
            'appealVideo' => $appealVideo,
            'appeal' => $appeal
        ];
        return view('admin.appeal.video', $responseData);
    }

    public function storeVideos(Request $request)
    {
        $validatedData['appeal_id'] = $request->appeal_id;
        $validatedData['video'] = $request->video;
        $appealVideo = $this->appealVideoService->createVideos($validatedData);
        $status = $appealVideo ? 'success' : 'error';
        $message = $appealVideo ? 'Appeal\'s video created successfully' : 'Appeal\'s video could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updateVideo(UpdateAppealVideoRequest $request, Appeal $appeal, AppealVideo $appealVideo)
    {
        $validatedData['appeal_id'] = $request->appeal_id;
        $validatedData['video'] = $request->video;
        if($appeal) {
            $appealVideo = $appealVideo->update($validatedData);
        } else {
            $appealVideo = null;
        }
        $status = $appealVideo ? 'success' : 'error';
        $message = $appealVideo ? 'Appeal\'s video updated successfully' : 'Appeal\'s video could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyVideo(Appeal $appeal, AppealVideo $appealVideo)
    {
        $isDeleted = $this->appealVideoService->deleteAppealVideo($appeal, $appealVideo);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Appeal\'s video section is deleted successfully' : 'Appeal\'s video could not be deleted';
        return redirect()->back()->with($status, $message);
    }
}
