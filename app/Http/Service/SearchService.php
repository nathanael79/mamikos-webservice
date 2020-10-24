<?php


namespace App\Http\Service;


use App\Models\Kost;

class SearchService
{
    public const ASCENDING = 'asc';
    public const DESCENDING = 'desc';
    private $kostModel;

    public function __construct(Kost $kostModel)
    {
        $this->kostModel = $kostModel;
    }

    public function searchKost($param, $keyword){
        if ($param != null){
            $data = $this->kostModel->where($param,'like','%'.$keyword.'%')
                ->orderBy('price',self::ASCENDING)
                ->get();
        }else{
            $data = $this->kostModel->where('name','like','%'.$keyword.'%')
                ->orWhere('city','like','%'.$keyword.'%')
                ->orWhere('address','like','%'.$keyword.'%')
                ->orWhere('price','like','%'.$keyword.'%')
                ->orderBy('price',self::ASCENDING)
                ->get();
        }

        return $data;
    }

}
