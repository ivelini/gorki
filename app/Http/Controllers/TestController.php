<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReservedRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ReservedRoomRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $userRepository = new UserRepository();
        $reservedRoomRepository = new ReservedRoomRepository();



        $url = url()->full();
        $parts = parse_url($url);

        if (array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query);
        }  else {
            $query = null;
        }

        $reservedRoomRepository = new ReservedRoomRepository();

        $reservedRoomRepository->getAll($query);


       dd($query);


    }
}
