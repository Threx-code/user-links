<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AdminInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(private AdminInterface $adminRepository){}
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('index');
    }

    public function allUsers(Request $request)
    {
        $users = $this->adminRepository->allUsers($request);
        return view('all-users', compact('users'));
    }

    public function editUser(Request $request)
    {
        $user = $this->adminRepository->getUser($request);
        return view('edit-user', compact('user'));
    }


    public function update(UpdateUserRequest $request)
    {
        return $this->adminRepository->editUser($request);

    }

    public function delete()
    {

    }

}
