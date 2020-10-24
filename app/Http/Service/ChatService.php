<?php


namespace App\Http\Service;


use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ChatService extends BaseService
{
    public function __construct(Chat $chat)
    {
        parent::__construct($chat);
    }
}
