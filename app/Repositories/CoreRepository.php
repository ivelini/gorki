<?php


namespace App\Repositories;


abstract class CoreRepository
{
    protected $model;

    abstract public function getModelClass();

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    public function startConditions()
    {
        return clone $this->model;
    }

    public function getModel($attribute, $value) {
        return $this->model->where($attribute, $value)->first();
    }

    public function modelsAttributesToArray($models)
    {
        $models =  $models->map(function ($item) {
            $arr = $item->getAttributes();

            if (count($arr) == 1) {
                $firstKey = array_key_first($arr);
                return $arr[$firstKey];
            }

            return $arr;
        });

        return $models;
    }
}
