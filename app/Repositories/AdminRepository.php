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

    /**
     * @param $request
     * @return string
     */
    public function editUser($request): string
    {
        return $this->adminService->editUser($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function deleteUser($request): mixed
    {
        return $this->adminService->deleteUser($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function allUsers($request): mixed
    {
        return $this->adminService->allUsers($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getUser($request): mixed
    {
        return $this->adminService->getUser($request);
    }
}
