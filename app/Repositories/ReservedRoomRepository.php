<?php


namespace App\Repositories;

use App\Models\ReservedRoom as Model;

class ReservedRoomRepository extends CoreRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $models = $this->startConditions()
            ->with('user')
            ->orderBy('id', 'DESC')
            ->get();

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

        $arr = $this->modelsAttributesToArray($models);
        $arr = $this->setAppruveStatus($arr);

        return $arr;
    }

    private function setAppruveStatus($arr)
    {
        $arr = $arr->map(function ($item) {
            if ($item->is_appruved) {
                $item->is_appruved = 'Подтверждена';
            } else {
                $item->is_appruved = 'Не подтверждена';
            }
            $item->user_name = !empty($item->user) ? $item->user->name : null;

            return $item;
        });

        return $arr;
    }
}
