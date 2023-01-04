<?php

namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Services\UserService;
use \Illuminate\Http\JsonResponse;
use JsonException;


class UserRepository implements UserInterface
{
    private UserService $userService;

    public function __construct()
    {
       $this->userService = new UserService();
    }

    public function createUser($request)
    {
        return $this->userService->createUser($request);
    }

    public function generateNewLink($request)
    {
        return $this->userService->generateNewLink($request);
    }

    public function deactivateLink($request)
    {
        return $this->userService->deactivateLink($request);
    }

    public function linkIsValid($request)
    {
        return $this->userService->linkIsValid($request);
    }

    public function feelingLucky($request)
    {
        return $this->userService->feelingLucky($request);
    }

    public function history($request)
    {
        return $this->userService->history($request);
    }
}
