<?php


namespace App\Repositories;

use App\Models\ReservedRoom as Model;

class ReservedRoomRepository extends CoreRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    public function getAll( $query = [])
    {
        $models = $this->startConditions()
            ->with('user')
            ->orderBy('id', 'DESC');

        if (array_key_exists('user_id', $query)) $models = $models->where('user_id', $query['user_id']);
        if (array_key_exists('is_appruved', $query)) $models = $models->where('is_appruved', $query['is_appruved']);
        if (array_key_exists('limit', $query)) $models = $models->take($query['limit']);

        $models = $models->get();

        $models = $this->setAppruveStatus($models);
        $arr = $this->modelsAttributesToArray($models);


        return $arr;
    }

    public function getAllForUser($user)
    {
        $models = $this->startConditions()
            ->where('user_id', $user->id)
            ->with('user')
            ->orderBy('id', 'DESC')
            ->get();

        $models = $this->setAppruveStatus($models);
        $arr = $this->modelsAttributesToArray($models);

        return $arr;
    }

    private function setAppruveStatus($arr)
    {
        $arr = $arr->map(function ($item) {
            if ($item->is_appruved) {
                $item->appruvedStatus = 'Подтверждена';
            } else {
                $item->appruvedStatus = 'Не подтверждена';
            }
            $item->user_name = !empty($item->user) ? $item->user->name : null;

            return $item;
        });

        return $arr;
    }
}
