<?php

namespace App\Repositories;

use App\Contracts\AdminInterface;
use App\Services\AdminService;

class AdminRepository implements UserInterface
{
    private AdminService $adminService;

    public function __construct()
    {
        $this->adminService = new AdminService();
    }

}
