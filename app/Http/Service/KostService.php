<?php


namespace App\Http\Service;


use App\Models\Kost;
use Illuminate\Database\Eloquent\Model;

class KostService extends BaseService
{
    public function __construct(Kost $kost)
    {
        parent::__construct($kost);
    }

    public function getKostsByUserID($userID){
        $data = $this->model->where('user_id',$userID)->get();

        return $data;
    }
}
