<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReservedRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ReservedRoomRepository;
use App\Repositories\UserRepository;

class TestController extends Controller
{
    public function test()
    {
        $userRepository = new UserRepository();
        $reservedRoomRepository = new ReservedRoomRepository();





       dd($reservedRoomRepository->getAllForUser((new User)->where('id', 1)->first()));


    }
}
