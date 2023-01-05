<?php

namespace App\Services;

use App\Models\User;

class AdminService
{

    public function allUsers($request)
    {
        return User::where('date_deleted', NULL)->orderBy('id', 'desc')->paginate(10);
    }

    public function getUser($request)
    {
        return User::where([
            'id' => $request->user_id,
            'date_deleted' => NULL
            ])->first();
    }

    public function editUser($request)
    {
        $userToEdit = $this->getUser($request);
        if($userToEdit){
            $userToEdit->username = trim($request ->username);
            $userToEdit->phone_number = trim($request->phone_number);
            $userToEdit->save();

            echo "User updated successfully";
        }
    }

}
