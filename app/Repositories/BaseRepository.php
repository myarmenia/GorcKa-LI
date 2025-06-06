<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class BaseRepository implements BaseInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById(int $id)
    {
        // return $this->model->findOrFail($id);

        try {
            return $this->model->find($id);

        } catch (Throwable $e) {
            return false;
        }
    }


    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $item = $this->model->findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function getActiveRows()
    {
        return $this->model->where('status', 1)->get();
    }

    public function getItemByIdWithRel($id, $relations = [])
    {
        return $this->model->where('id', $id)->with($relations)->first();
    }

}
