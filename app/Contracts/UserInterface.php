<?php

namespace App\Contracts;

interface UserInterface
{
    public function getAllOrders($request);
    public function topDistributors($request);
    public function autocomplete($request);
}
