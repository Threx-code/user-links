<?php

namespace App\Repositories;

use App\Contracts\AdminInterface;
use App\Services\AdminService;

class AdminRepository implements AdminInterface
{
    private AdminService $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

    public function editUser($request)
    {
        return $this->adminService->editUser($request);
    }

    public function deleteUser($request)
    {
        return $this->adminService->deleteUser($request);
    }

    public function allUsers($request)
    {
        return $this->adminService->allUsers($request);
    }
    public function getUser($request)
    {
        return $this->adminService->getUser($request);
    }
}
