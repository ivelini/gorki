<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ReservedRoom;
use App\Repositories\ReservedRoomRepository;

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

        $reservedRoomRepository = new ReservedRoomRepository();

        $reserve = ($user->roles->first()->name == 'Administrator') ?
            $reservedRoomRepository->getAll() :
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

        $userModel = new ReservedRoom();
        $userModel->user_id = !empty($data['userId']) ? $data['userId'] : $request->user()->id;
        $userModel->reserverd_at = $date->format('Y-m-d');
        $userModel->save();

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
        //
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
logger($request->user()->tokenCan('role:Administrator'));
        if (!empty($reservedRoom) && $reservedRoom->user_id == $request->user()->id ||
            $request->user()->tokenCan('role:admin') == true) {

            $reservedRoom->delete();
            return ['status' => 'OK'];
        }

        return ['status' => 'error'];
    }
}
