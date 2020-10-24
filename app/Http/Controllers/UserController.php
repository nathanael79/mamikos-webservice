<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Service\UserService;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

}
