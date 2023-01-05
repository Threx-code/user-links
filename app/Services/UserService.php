<?php

namespace App\Services;

use App\Helpers\UserHelper;
use App\Models\LuckHistory;
use App\Models\User;
use App\Models\UserLink;
use Exception;
use Illuminate\Support\Facades\URL;

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
     * @param $userId
     * @return string
     * @throws Exception
     */
    protected function linkCreator($userId): string
    {
        $linkGenerated = UserHelper::uniqueLink();
        if($userId){
            UserLink::create([
                'user_id' => $userId,
                'token' => $linkGenerated,
            ]);
            return URL::temporarySignedRoute('user-page', now()->addDays(7), ['token' => $linkGenerated]);
        }
        return "Sorry invalid data";

    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function createUser($request): string
    {
        $user = $this->userCreator($request);
        return $this->linkCreator($user->id);
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function generateNewLink($request): string
    {
        $user = $this->getUserId($request);
        return $this->linkCreator($user->user_id);
    }

    /**
     * @param $request
     * @return string
     */
    public function deactivateLink($request): string
    {
        $userLink = $this->getUserId($request);
        $userLink->token_expires = UserHelper::tokenExpireTime();
        $userLink->save();
        return "link deactivated";
    }

    /**
     * @param $request
     * @return mixed
     */
    public function linkIsValid($request): mixed
    {
        return UserLink::where('token', $request->token)->whereNull('token_expires')->count();
    }

    /**
     * @param $request
     * @return float|int
     * @throws Exception
     */
    public function feelingLucky($request): float|int
    {
        $score = UserHelper::randomNumber();
        $user = $this->getUserId($request);
        LuckHistory::create([
            'user_id' => $user->user_id,
            'score' => $score
        ]);
        return $score;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function history($request): mixed
    {
        $user = $this->getUserId($request);
        return LuckHistory::where('user_id', $user->user_id)->orderBy('id', 'desc')->get()->take(3);
    }

}
