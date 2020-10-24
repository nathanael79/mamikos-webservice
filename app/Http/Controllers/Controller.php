<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const HTTP_STATUS_OK = 200;
    public const HTTP_STATUS_CREATED = 201;
    public const HTTP_STATUS_NO_CONTENT = 204;
    public const HTTP_STATUS_BAD_REQUEST = 400;
    public const HTTP_STATUS_UNAUTHORIZED = 401;
    public const HTTP_STATUS_FORBIDDEN = 403;
    public const HTTP_STATUS_NOT_FOUND = 404;
    public const HTTP_STATUS_INTERNAL_SERVER_ERROR = 500;

    public const HTTP_STATUS_OK_MESSAGE = 'SUCCESS';
    public const HTTP_STATUS_CREATED_MESSAGE = 'CREATED';
    public const HTTP_STATUS_NO_CONTENT_MESSAGE = 'NO CONTENT';
    public const HTTP_STATUS_BAD_REQUEST_MESSAGE = 'BAD REQUEST';
    public const HTTP_STATUS_UNAUTHORIZED_MESSAGE = 'UNAUTHORIZED';
    public const HTTP_STATUS_FORBIDDEN_MESSAGE = 'FORBIDDEN';
    public const HTTP_STATUS_NOT_FOUND_MESSAGE = 'NOT FOUND';
    public const HTTP_STATUS_INTERNAL_SERVER_ERROR_MESSAGE = 'INTERNAL SERVER ERROR';


    protected function responseJson($data, ?string $message , $code = 200){
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
