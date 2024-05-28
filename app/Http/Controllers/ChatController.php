<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat\Room;
use App\Models\Chat\Chat;
use Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::with('unreadChat')->where('id','!=', Auth::user()->id)->get();

        return view('chat.index', compact('users'));
    }

    public function kirimPesan(Request $request)
    {
        $chat = new Chat;
        $chat->id_room = trim($request->data['room_id'],"room-");
        $chat->id_pengirim = Auth::user()->id;
        $chat->id_penerima = $request->data['penerima_id'];
        $chat->pesan = $request->data['msg'];
        $chat->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil !'
        ]);
    }
}
