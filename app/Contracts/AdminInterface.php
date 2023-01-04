<?php

namespace App\Contracts;

interface AdminInterface
{
    public function createUser($request);
    public function editUser($request);
    public function deleteUser($request);

}
