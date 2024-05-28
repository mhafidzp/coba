<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat\Room;
use App\Models\Chat\Chat;
use Auth;

class RoomController extends Controller
{
    public function cekRoom(Request $request)
    {
        //cek room
        $data = Room::where('id_pengirim',$request->id_pengirim)
            ->where('id_penerima',$request->id_penerima)
            ->orWhereRaw('id_pengirim =' . $request->id_penerima . ' AND id_penerima='. $request->id_pengirim)
            ->first();

        //insert room
        if(empty($data)){
            $room = new Room;
            $room->id_pengirim = $request->id_pengirim;
            $room->id_penerima = $request->id_penerima;
            $room->save();

            return response()->json($room);
        }

        //tampil chat
        $id_pengirim = $request->id_pengirim;
        $data_pesan = Chat::with('user')->where('id_room', $data->id)->get();
        $pesan = '';

        foreach($data_pesan as $val){
            if($val->id_pengirim == $id_pengirim){
                $pesan .= '<div class="d-flex justify-content-end mb-10">'.
                            '<div class="d-flex flex-column align-items-end">'.
                                '<div class="d-flex align-items-center mb-2">'.
                                    '<div class="me-3">'.
                                        '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end" data-kt-element="message-text">' . $val->pesan .'</div>'.
                            '</div>'.
                        '</div>';
            }else{
                $pesan .= '<div class="d-flex justify-content-start mb-10">'.
                            '<div class="d-flex flex-column align-items-start">'.
                                '<div class="d-flex align-items-center mb-2">'.
                                    '<div class="me-3">'.
                                        '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">'. $val->user->name .'</a>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="p-5 rounded bg-light-info text-gray-900 fw-semibold mw-lg-400px text-start" data-kt-element="message-text">' . $val->pesan .'</div>'.
                            '</div>'.
                        '</div>';
            }
        }

        //update read chat
        Chat::where('id_penerima', $id_pengirim)->where('id_pengirim', $request->id_penerima)->update([
            'status' => '1'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil !',
            'room_id' => $data->id,
            'pesan' => $pesan
        ]);
    }
}
