<?php

namespace App\Contracts;

interface AdminInterface
{
    public function editUser($request);
    public function deleteUser($request);
    public function allUsers($request);
    public function getUser($request);

}
