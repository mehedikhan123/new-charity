<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CountryService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    protected UserService $userService;
    protected CountryService $countryService;

    public function __construct(UserService $userService, CountryService $countryService)
    {
        $this->userService = $userService;
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getUsers();
        $responseData = [
            'users' => $users
        ];
        return view('admin.user.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function destroy(User $user)
    {
        if(isset($user) && isset($user->photo)) {
            unlink(public_path('storage/uploads/photo/'. $user->photo));
        }
        $isDeleted = $user->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'User is deleted successfully' : 'User could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, User $user)
    {
        $user->is_active = $request->is_active ? false : true;
        $isUpdated = $user->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'User\'s status is updated successfully' : 'User\'s status could not be updated successfully';
        return redirect()->route('admin.users.index')->with($status, $message);
    }
}
