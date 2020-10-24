<?php

namespace App\Http\Controllers;

use App\Http\Service\KostService;
use App\Http\Service\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $searchService;
    private $kostService;

    public function __construct(SearchService $searchService, KostService $kostService)
    {
        $this->searchService = $searchService;
        $this->kostService = $kostService;
    }

    public function searchKost(Request $request){
        $requests = $request->only(['keyword']);

        if($request->keyword == null){
            return $this->responseJson(null, self::HTTP_STATUS_NO_CONTENT_MESSAGE, self::HTTP_STATUS_NO_CONTENT);
        }

        $fieldParams = $request->query('fields');
        if($fieldParams != null){
            $params = explode(',', $fieldParams);
            $data = [];
            foreach ($params as $param){
                if(in_array($param, $this->availableSearchKostParams())){
                    $data [] = $this->searchService->searchKost($param, $requests['keyword']);
                }
            }
        }else{
            $data [] = $this->searchService->searchKost(null, $requests['keyword']);
        }

        if(empty($data)){
            return $this->responseJson(null, self::HTTP_STATUS_NO_CONTENT_MESSAGE, self::HTTP_STATUS_NO_CONTENT);
        }else{
            return $this->responseJson($data, self::HTTP_STATUS_OK_MESSAGE, self::HTTP_STATUS_OK);
        }

    }

    private function availableSearchKostParams(){
        return [
            'name',
            'location',
            'price'
        ];
    }
}
