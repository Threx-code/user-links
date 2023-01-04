<?php

namespace App\Contracts;

interface UserInterface
{
    public function createUser($request);
    public function generateNewLink($request);
    public function deactivateLink($request);
    public function linkIsValid($request);
    public function feelingLucky($request);
    public function history($request);
}
