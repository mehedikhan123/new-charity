<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Program\StoreProgramPhotoRequest;
use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\StoreProgramVideoRequest;
use App\Http\Requests\Program\UpdateProgramPhotoRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Http\Requests\Program\UpdateProgramVideoRequest;
use App\Models\Program;
use App\Models\ProgramPhoto;
use App\Models\ProgramTicket;
use App\Models\ProgramVideo;
use App\Services\Core\HelperService;
use App\Services\ProgramPhotoService;
use App\Services\ProgramService;
use App\Services\ProgramTicketService;
use App\Services\ProgramVideoService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    protected ProgramService $programService;
    protected ProgramTicketService $programTicketService;
    protected ProgramPhotoService $programPhotoService;
    protected ProgramVideoService $programVideoService;
    protected UserService $userService;

    public function __construct(ProgramService $programService, ProgramTicketService $programTicketService, ProgramPhotoService $programPhotoService, ProgramVideoService $programVideoService, UserService $userService)
    {
        $this->programService = $programService;
        $this->programTicketService = $programTicketService;
        $this->programPhotoService = $programPhotoService;
        $this->programVideoService = $programVideoService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = $this->programService->getAllPrograms();
        $responseData = [
            'programs' => $programs
        ];
        return view('admin.program.index', $responseData);
    }

    public function create()
    {
        $programTypes = HelperService::getProgramTypes();
        $responseData = [
            'programTypes' => $programTypes
        ];
        return view('admin.program.create', $responseData);
    }

    public function store(StoreProgramRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'program_photo');
        $program = $this->programService->create($validatedData);
        $status = $program ? 'success' : 'error';
        $message = $program ? 'Program section is created successfully' : 'Program could not be created';
        return redirect()->route('admin.programs.index')->with($status, $message);
    }

    public function edit(Program $program)
    {
        $programTypes = HelperService::getProgramTypes();
        $responseData = [
            'program' => $program,
            'programTypes' => $programTypes
        ];
        return view('admin.program.create', $responseData);
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'program_photo', $program->photo);
        }
        $isUpdated = $program->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Program section is updated successfully' : 'Program could not be updated';
        return redirect()->route('admin.programs.index')->with($status, $message);
    }

    public function destroy(Program $program)
    {
        if(isset($program) && isset($program->photo)) {
            unlink(public_path('storage/uploads/photo/'. $program->photo));
        }
        $isDeleted = $program->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Program section is deleted successfully' : 'Program could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Program $program)
    {
        $program->is_active = $request->is_active ? false : true;
        $isUpdated = $program->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Program section\'s status is updated successfully' : 'Program section\'s status could not be updated successfully';
        return redirect()->route('admin.programs.index')->with($status, $message);
    }

    public function photos(Program $program, ProgramPhoto $programPhoto = null)
    {
        $programPhotos = $this->programPhotoService->getProgramPhotos($program);
        $responseData = [
            'programPhotos' => $programPhotos,
            'programPhoto' => $programPhoto,
            'program' => $program
        ];
        return view('admin.program.photo', $responseData);
    }

    public function storePhotos(Request $request)
    {
        $validatedData = $request->all();
        $validatedData['photo'] = HelperService::uploadPhotos(request()->file('photo'), 'program_photo');
        $programPhoto = $this->programPhotoService->createPhotos($validatedData);
        $status = $programPhoto ? 'success' : 'error';
        $message = $programPhoto ? 'Program\'s photo created successfully' : 'Program\'s photo could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updatePhoto(UpdateProgramPhotoRequest $request, Program $program, ProgramPhoto $programPhoto)
    {
        $validatedData['program_id'] = $request->program_id;
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'program_photo', $programPhoto->photo);
        }
        if($program) {
            $programPhoto = $programPhoto->update($validatedData);
        } else {
            $programPhoto = null;
        }
        $status = $programPhoto ? 'success' : 'error';
        $message = $programPhoto ? 'Program\'s photo updated successfully' : 'Program\'s photo could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyPhoto(Program $program, ProgramPhoto $programPhoto)
    {
        $isDeleted = $this->programPhotoService->deleteProgramPhoto($program, $programPhoto);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Program\'s photo section is deleted successfully' : 'Program\'s photo could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function videos(Program $program, ProgramVideo $programVideo = null)
    {
        $programVideos = $this->programVideoService->getProgramVideos($program);
        $responseData = [
            'programVideos' => $programVideos,
            'programVideo' => $programVideo,
            'program' => $program
        ];
        return view('admin.program.video', $responseData);
    }

    public function storeVideos(Request $request)
    {
        $validatedData['program_id'] = $request->program_id;
        $validatedData['video'] = $request->video;
        $programVideo = $this->programVideoService->createVideos($validatedData);
        $status = $programVideo ? 'success' : 'error';
        $message = $programVideo ? 'Program\'s video created successfully' : 'Program\'s video could not be created';
        return redirect()->back()->with($status, $message);    
    }

    public function updateVideo(UpdateProgramVideoRequest $request, Program $program, ProgramVideo $programVideo)
    {
        $validatedData['program_id'] = $request->program_id;
        $validatedData['video'] = $request->video;
        if($program) {
            $programVideo = $programVideo->update($validatedData);
        } else {
            $programVideo = null;
        }
        $status = $programVideo ? 'success' : 'error';
        $message = $programVideo ? 'Program\'s video updated successfully' : 'Program\'s video could not be updated';
        return redirect()->back()->with($status, $message);    
    }

    public function destroyVideo(Program $program, ProgramVideo $programVideo)
    {
        $isDeleted = $this->programVideoService->deleteProgramVideo($program, $programVideo);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Program\'s video section is deleted successfully' : 'Program\'s video could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function tickets(Program $program)
    {
        $programTickets = $this->programTicketService->getProgramTickets($program);
        $responseData = [
            'program' => $program,
            'programTickets' => $programTickets
        ];
        return view('admin.program.tickets', $responseData);
    }

    public function ticketInvoice(Program $program, ProgramTicket $programTicket)
    {
        $ticketData = $this->programTicketService->getProgramTicket($program, $programTicket);
        $userData = $this->userService->getUser($ticketData->user_id);
        $responseData = [
            'ticketData' => $ticketData,
            'userData' => $userData
        ];
        return view('admin.program.invoice', $responseData);
    }
}
