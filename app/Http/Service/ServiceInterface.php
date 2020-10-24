<?php


namespace App\Http\Service;


interface ServiceInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function findAll();
    public function update(int $id, array $data);
    public function delete(int $id);
}
