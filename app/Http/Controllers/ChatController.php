<?php


namespace App\Http\Controllers;


use App\Http\Service\ChatService;
use App\Http\Service\JWTService;
use App\Http\Service\UserService;
use Illuminate\Http\Request;
use Validator;
use Exception;

class ChatController extends Controller
{
    private $chatService;
    private $jwtService;
    private $userService;

    public function __construct(ChatService $chatService, JWTService $jwtService, UserService $userService)
    {
        $this->chatService = $chatService;
        $this->jwtService = $jwtService;
        $this->userService = $userService;
    }

    public function create(Request $request){
        $user = $this->jwtService->getAuthenticatedUser();

        if($user->role == 'OWNER'){
            return $this->responseJson(null, self::HTTP_STATUS_FORBIDDEN_MESSAGE, self::HTTP_STATUS_FORBIDDEN);
        }

        if(($user->credit - 5 < 0)){
            return $this->responseJson(null, self::HTTP_STATUS_FORBIDDEN_MESSAGE, self::HTTP_STATUS_FORBIDDEN);
        }

        //retrieve only message
        $data = $request->only([
            'kost_id',
            'message'
        ]);

        //check validation
        $validator = Validator::make($data, [
            'kost_id' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors(), self::HTTP_STATUS_BAD_REQUEST);
        }

        $data['user_id'] = $user->id;
        try {
            //decrease the credit
            $this->userService->decreaseCredit($user->id);
            $chat = $this->chatService->create($data);
            return $this->responseJson($data, self::HTTP_STATUS_CREATED_MESSAGE, self::HTTP_STATUS_CREATED);
        }catch (Exception $e){
            return $this->responseJson(null, self::HTTP_STATUS_INTERNAL_SERVER_ERROR_MESSAGE, self::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request){
        $data = $request->only([
            'replies'
        ]);

        $validator = Validator::make($data, [
            'replies' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors(), self::HTTP_STATUS_BAD_REQUEST);
        }

        try {
            $chat = $this->chatService->update($id, $data);

            return $this->responseJson($data, self::HTTP_STATUS_CREATED_MESSAGE, self::HTTP_STATUS_CREATED);
        }catch (Exception $e){
            return $this->responseJson(null, self::HTTP_STATUS_INTERNAL_SERVER_ERROR_MESSAGE, self::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

}
