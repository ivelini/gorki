<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test()
    {
        $user = (new User())
            ->where('id', 1)
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
        dd($user);
    }
}
