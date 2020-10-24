<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->only("email", "password");

        try{
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], self::HTTP_STATUS_BAD_REQUEST);
            }
            return $this->responseJson($token, 'login successful', self::HTTP_STATUS_OK);

        }catch (JWTException $e){
            return $this->responseJson(null, 'could not create token', self::HTTP_STATUS_NO_CONTENT);
        }
    }

}
