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

    /**
     * @param $request
     * @return array
     */
    public function getAllOrders($request): array
    {
        return $this->orderService->getAllOrders($request);
    }


    /**
     * @param $request
     * @return mixed
     */
    public function topDistributors($request): mixed
    {
        return $this->orderService->topDistributors($request);
    }

    public function autocomplete($request)
    {
        return $this->orderService->autocomplete($request);
    }
}
