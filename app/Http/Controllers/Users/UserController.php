<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Validators\Request\AllOrderValidator;
use App\Validators\Request\Autocomplete;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Contracts\UserInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserInterface  $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request): mixed
    {
        return view('index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(UserCreateRequest $request)
    {
        $allOrder = $this->userRepository->createUser($request);
        return response()->json();
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function getAllOrderView(Request $request): Factory|View|Application
    {
        $orders = $this->orderRepository->getAllOrders($request);
        $data = $orders['data'];
        $orders = $orders['orders'];
        return view('orders', compact('orders', 'data'));
    }


    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function getTopDistributorsView(Request $request): Factory|View|Application
    {
        $distributors = $this->userRepository->topDistributors($request);
        return view('distributors', compact('distributors', ));
    }

}
