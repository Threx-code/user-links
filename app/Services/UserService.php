<?php

namespace App\Services;

use App\Helpers\KeywordProcessingHelper;
use App\Helpers\UserHelper;
use App\Models\Orders;
use App\Models\User;
use App\Models\UserLink;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Validators\RepositoryValidator;
use Illuminate\Support\Facades\URL;
use SM\Backend\KeywordList\Managers\ListManager;
use SM\Backend\Topics\Managers\BackendManager;

class UserService
{
    /**
     * @param $request
     * @return mixed
     */
    protected function userCreator($request): mixed
    {
        return User::create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
        ]);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getUserId($request): mixed
    {
        return UserLink::where('token', $request->token)->whereNull('token_expires')->first();
    }

    /**
     * @param $user
     * @return string
     * @throws Exception
     */
    protected function linkCreator($user): string
    {
        $linkGenerated = UserHelper::uniqueLink();
        if($user){
            UserLink::create([
                'user_id' => $user->id,
                'token' => $linkGenerated,
            ]);
        }
        return URL::temporarySignedRoute('user-page', now()->addDays(7), ['token' => $linkGenerated]);
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function createUser($request): string
    {
        $user = $this->userCreator($request);
        return $this->linkCreator($user);
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function generateNewLink($request): string
    {
        $user = $this->getUserId($request);
        return $this->linkCreator($user);
    }

    /**
     * @param $request
     * @return void
     */
    public function deactivateLink($request): void
    {$userLink = $this->getUserId($request);
        $userLink->token_expired = UserHelper::tokenExpireTime();
        $userLink->save();
    }

    public function linkIsValid($request)
    {
        return UserLink::where('token', $request->token)->whereNull('token_expires')->count();
    }


    public function feelingLucky($request)
    {
    }

    public function history($request)
    {
    }

}
