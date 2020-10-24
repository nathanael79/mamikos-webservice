<?php

namespace App\Http\Controllers;

use App\Http\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Validator;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $data = $request->only([
            'email',
            'name',
            'password',
            'address',
            'city',
            'credit',
            'role'
        ]);

        $validator = Validator::make($data, [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:6',
            'address' => 'required',
            'city' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors(), self::HTTP_STATUS_BAD_REQUEST);
        }

        try {
            $user = $this->userService->create(array_merge($data, [
                'credit' => $this->getCredit($data['role']),
                'password' => Hash::make($data['password'])
            ]));

            return $this->responseJson($user, self::HTTP_STATUS_CREATED_MESSAGE, self::HTTP_STATUS_CREATED);
        } catch (Exception $e) {
            return $this->responseJson(null, $e->getMessage(), self::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    private function getCredit(string $role){
        switch ($role) {
            case 'REGULER':
                $credit = 20;
                break;
            case 'PREMIUM':
                $credit = 40;
                break;
            default:
                $credit = 0;
                break;
        }

        return $credit;
    }
}
