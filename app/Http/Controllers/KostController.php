<?php


namespace App\Http\Controllers;


use App\Http\Service\JWTService;
use App\Http\Service\KostService;
use Illuminate\Http\Request;
use Validator;
use Exception;

class KostController extends Controller
{
    private $kostService;
    private $jwtService;

    public function __construct(KostService $kostService)
    {
        $this->kostService = $kostService;
        $this->jwtService = new JWTService();
    }

    public function create(Request $request){

        $data = $request->only([
            'name',
            'address',
            'city',
            'detail',
            'room_amount',
            'availability',
            'price'
        ]);

        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required|min:6',
            'city' => 'required',
            'detail' => 'required|min:6',
            'room_amount' => 'required|numeric',
            'availability' => 'required|in:AVAILABLE,NOT-AVAILABLE',
            'price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors(), self::HTTP_STATUS_BAD_REQUEST);
        }

        $user = $this->jwtService->getAuthenticatedUser();
        $data['user_id'] = $user->id;

        try{
            $data = $this->kostService->create($data);
            return $this->responseJson($data, self::HTTP_STATUS_CREATED_MESSAGE, self::HTTP_STATUS_CREATED);
        }catch (Exception $e){
            return $this->responseJson(null, $e->getMessage(), self::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request){
        $data = $request->only([
            'name',
            'address',
            'city',
            'detail',
            'room_amount',
            'availability',
            'price'
        ]);

        $validator = Validator::make($data, [
            'name' => 'sometimes|required',
            'address' => 'sometimes|required|min:6',
            'city' => 'sometimes|required',
            'detail' => 'sometimes|required|min:6',
            'room_amount' => 'sometimes|required|numeric',
            'availability' => 'sometimes|required|in:AVAILABLE,NOT-AVAILABLE',
            'price' => 'sometimes|required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->responseJson(null, $validator->errors(), self::HTTP_STATUS_BAD_REQUEST);
        }

        try{
            $data = $this->kostService->update($id, $data);
            return $this->responseJson($data, self::HTTP_STATUS_CREATED_MESSAGE, self::HTTP_STATUS_CREATED);
        }catch (Exception $e){
            return $this->responseJson(null, $e->getMessage(), self::HTTP_STATUS_INTERNAL_SERVER_ERROR);
        }
    }

    public function getKost($id){
        $data = $this->kostService->findById($id);

        if(empty($data)){
            return $this->responseJson(null, self::HTTP_STATUS_NOT_FOUND_MESSAGE, self::HTTP_STATUS_NOT_FOUND);
        }else{
            return $this->responseJson($data, self::HTTP_STATUS_OK_MESSAGE, self::HTTP_STATUS_OK);
        }
    }

    public function getKosts(){
        $data = $this->kostService->findAll();

        if(empty($data)){
            return $this->responseJson($data, self::HTTP_STATUS_NO_CONTENT_MESSAGE, self::HTTP_STATUS_NO_CONTENT);
        }else{
            return $this->responseJson($data, self::HTTP_STATUS_OK_MESSAGE, self::HTTP_STATUS_OK);
        }
    }

    public function delete($id){
        $data = $this->kostService->delete($id);
        return $this->responseJson(null, self::HTTP_STATUS_OK_MESSAGE, self::HTTP_STATUS_OK);
    }

}
