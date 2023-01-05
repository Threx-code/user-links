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

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function allUsers(Request $request): View|Factory|Application
    {
        $users = $this->adminRepository->allUsers($request);
        return view('all-users', compact('users'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function editUser(Request $request): View|Factory|Application
    {
        $user = $this->adminRepository->getUser($request);
        return view('edit-user', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @return void
     */
    public function update(UpdateUserRequest $request): void
    {
        echo $this->adminRepository->editUser($request);

    }

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void
    {
        echo $this->adminRepository->deleteUser($request);
    }

}
