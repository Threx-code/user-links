<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Validators\Request\AllOrderValidator;
use App\Validators\Request\Autocomplete;
use Carbon\Carbon;
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

    public function generateLink(Request $request)
    {
        return $this->userRepository->generateNewLink($request);
    }
    public function deactivateLink(Request $request)
    {
        return $this->userRepository->deactivateLink($request);
    }
    public function feelingLucky(Request $request)
    {

    }
    public function history(Request $request)
    {

    }

}
