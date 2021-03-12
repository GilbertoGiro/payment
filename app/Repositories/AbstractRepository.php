<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * Variable who contains repository model
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Method to get all Model Objects
     * @return Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Method to get Model Object by id
     * @param integer $id
     * @return Model
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Method to get Model Object by passed Params
     * e.g: ['name' => 'Gilberto Giro Resende']
     * @param array $data
     * @return Model|null
     */
    public function findBy(array $data)
    {
        $return = $this->model->all();
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $return = $return->whereIn($key, $value);
                continue;
            }
            $return = $return->where($key, $value);
        }
        return $return->first();
    }

    /**
     * Method to Create Model Object
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Method to Get the first occurrence or Create an Model Object if that doesn't exists
     * @param array $condition
     * @param array $data
     * @return Model
     */
    public function firstOrCreate(array $condition, array $data)
    {
        return $this->model->firstOrCreate($condition, $data);
    }

    /**
     * Method to Get the first occurrence or Create an Model Object if that doesn't exists
     * @param array $condition
     * @param array $data
     * @return Model
     */
    public function firstOrNew(array $condition, array $data)
    {
        return $this->model->firstOrNew($condition, $data);
    }

    /**
     * Method to insert given data on related model
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * Method to update Model Object
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Method to Create an Model Object or Update it if exists
     * @param array $condition
     * @param array $data
     * @return Model
     */
    public function updateOrCreate(array $condition, array $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    /**
     * Method to delete Model Object
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Method to get model table name
     * @return string
     */
    public function getTable(): string
    {
        return $this->model->getTable();
    }

    /**
     * Method to get repository model
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }
}
