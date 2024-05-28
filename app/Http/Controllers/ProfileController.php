<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        //clear tmp file
        Storage::deleteDirectory('public/tmp/users/'. Auth()->user()->id);

        return view('profile.index');
    }

    public function update(Request $request, $id)
    {
        try {

            $user = User::find($id);

            if($request->card){
                if($user->card){
                    Storage::disk('public')->delete("users/cards/$user->card");
                }

                $card = Str::after($request->input('card'), "tmp/users/$id/");
                Storage::disk('public')->move("tmp/users/$id/$card", "users/cards/$card");

                $user->card = $card;
            }

            if($request->foto){
                if($user->foto){
                    Storage::disk('public')->delete("users/images/$user->foto");
                }

                $foto = Str::after($request->input('foto'), "tmp/users/$id/");
                Storage::disk('public')->move("tmp/users/$id/$foto", "users/images/$foto");

                $user->foto = $foto;
            }

            $user->name = $request->name;
            $user->address = $request->address;
            $user->save();

            return redirect()->back()->with('berhasil','Data Berhasil di Simpan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal','Terjadi Kesalahan!');
        }
    }

    public function upload(Request $request)
    {
        if ($request->file('foto')) {
            $path = $request->file('foto')->store('tmp/users/' . Auth()->user()->id, 'public');
        }

        if ($request->file('card')) {
            $path = $request->file('card')->store('tmp/users/' . Auth()->user()->id, 'public');
        }
        return $path;
    }

    public function revert(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }
}
