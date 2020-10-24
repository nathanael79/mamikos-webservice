<?php


namespace App\Http\Service;


use App\Models\User;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function decreaseCredit(int $id){
        $user = $this->findById($id);
        $credit = $user->credit - 5;
        $data['credit'] = $credit;
        $result = $this->update($id, $data);

        return $result;
    }

    public function resetCredit(){
        $this->model->where('role','REGULER')->where('credit','<',20)->update(['credit' => 20]);
        $this->model->where('role','PREMIUM')->where('credit','<',40)->update(['credit' => 40]);
    }

}
