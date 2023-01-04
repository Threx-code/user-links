<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Contracts\UserInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('index');
    }

    /**
     * @param UserCreateRequest $request
     * @return mixed
     */
    public function store(UserCreateRequest $request): mixed
    {
        return $this->userRepository->createUser($request);

    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function uniqueLink(Request $request): View|Factory|Application
    {
        $linkIsValid = $this->userRepository->linkIsValid($request);
        if (!$linkIsValid) {
            return view('link-expired');
        }
        return view('unique-link', compact('request'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function generateLink(Request $request): mixed
    {
        return $this->userRepository->generateNewLink($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function deactivateLink(Request $request): mixed
    {
        return $this->userRepository->deactivateLink($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function feelingLucky(Request $request): void
    {
        echo $this->userRepository->feelingLucky($request);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function history(Request $request): View|Factory|Application
    {
        $histories = $this->userRepository->history($request);
        return view('history-result', compact('histories'));
    }

}
