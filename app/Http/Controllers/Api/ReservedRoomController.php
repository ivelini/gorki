<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ReservedRoom;
use App\Repositories\ReservedRoomRepository;
use Illuminate\Support\Facades\Route;

class ReservedRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $url = url()->full();
        $parts = parse_url($url);

        if (array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query);
        }  else {
            $query = [];
        }

        $reservedRoomRepository = new ReservedRoomRepository();

        $reserve = ($user->roles->first()->name == 'Administrator') ?
            $reservedRoomRepository->getAll($query) :
            $reservedRoomRepository->getAllForUser($user);

        return $reserve;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $date = new Carbon($data['date']);

        $reservedRoomModel = new ReservedRoom();
        $reservedRoomModel->user_id = !empty($data['userId']) ? $data['userId'] : $request->user()->id;
        $reservedRoomModel->reserverd_at = $date->format('Y-m-d');
        $reservedRoomModel->save();

        return ['status' => 'OK'];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        $date = new Carbon($data['date']);
        $reservedRoomRepository = new ReservedRoomRepository();
        $reservedRoomModel = $reservedRoomRepository->getModel('id', $id);

        $reservedRoomModel->user_id = !empty($data['userId']) ? $data['userId'] : null;
        $reservedRoomModel->reserverd_at = $date->format('Y-m-d');
        $reservedRoomModel->is_appruved = !empty($data['isAppruved']);
        $reservedRoomModel->save();

        return ['status' => 'OK'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $reservedRoom = (new ReservedRoomRepository)->getModel('id', $id);

        if (!empty($reservedRoom) && $reservedRoom->user_id == $request->user()->id ||
            $request->user()->tokenCan('role:admin') == true) {

            $reservedRoom->delete();
            return ['status' => 'OK'];
        }

        return ['status' => 'error'];
    }
}
