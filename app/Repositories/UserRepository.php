<?php

namespace App\Repositories;

use App\Contracts\UserInterface;
use App\Services\UserService;
use Exception;
use \Illuminate\Http\JsonResponse;
use JsonException;


class UserRepository implements UserInterface
{
    private UserService $userService;

    public function __construct()
    {
       $this->userService = new UserService();
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function createUser($request): string
    {
        return $this->userService->createUser($request);
    }

    /**
     * @param $request
     * @return string
     * @throws Exception
     */
    public function generateNewLink($request): string
    {
        return $this->userService->generateNewLink($request);
    }

    /**
     * @param $request
     * @return string
     */
    public function deactivateLink($request): string
    {
        return $this->userService->deactivateLink($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function linkIsValid($request): mixed
    {
        return $this->userService->linkIsValid($request);
    }

    /**
     * @param $request
     * @return float|int
     * @throws Exception
     */
    public function feelingLucky($request): float|int
    {
        return $this->userService->feelingLucky($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function history($request): mixed
    {
        return $this->userService->history($request);
    }
}
