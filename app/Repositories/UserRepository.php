<?php


namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Support\Facades\Hash;


class UserRepository extends CoreRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    public function getAdminUser()
    {
        $user = $this->startConditions()
            ->whereHas('roles', function ($query) {
                $query
                    ->where('role_id', 1);
            })
            ->first();

        return $user;
    }

    public function userIsVerified($email, $password)
    {
        $user = $this->startConditions()
            ->where('email',  $email)
            ->first();

        if(!empty($user) && Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin($id)
    {
        $user = $this->startConditions()
            ->where('id', $id)
            ->whereHas('roles', function ($query) {
                $query
                    ->where('role_id', 1);
            })
            ->first();

        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
    }
}
