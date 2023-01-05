<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class AdminService
{

    /**
     * @param $request
     * @return mixed
     */
    public function allUsers($request): mixed
    {
        return User::where('date_deleted', NULL)->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getUser($request): mixed
    {
        return User::where([
            'id' => $request->user_id,
            'date_deleted' => NULL
            ])->first();
    }

    /**
     * @param $request
     * @return string
     */
    public function editUser($request): string
    {
        $userToEdit = $this->getUser($request);
        if($userToEdit){
            $userToEdit->username = trim($request ->username);
            $userToEdit->phone_number = trim($request->phone_number);
            $userToEdit->save();
            return  "User updated successfully";
        }
        return  "User update failed";
    }

    /**
     * @param $request
     * @return string
     */
    public function deleteUser($request): string
    {
        $userToEdit = $this->getUser($request);
        if($userToEdit){
            $userToEdit->date_deleted = Carbon::now();
            $userToEdit->save();
            return  "User deleted";
        }
        return  "User deletion failed";
    }
}
