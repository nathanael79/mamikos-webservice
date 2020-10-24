<?php


namespace App\Http\Service;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
