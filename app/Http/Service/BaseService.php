<?php


namespace App\Http\Service;


use Illuminate\Database\Eloquent\Model;

class BaseService implements ServiceInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $user = $this->model->create($data);

        return $user;
    }

    public function findById(int $id)
    {
        $data = $this->model->find($id);

        return $data;
    }

    public function findAll()
    {
        $data = $this->model->all();

        return $data;
    }

    public function update(int $id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->findById($id);
        $user->delete();

        return $user;
    }
}
