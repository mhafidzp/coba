<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chat\Room;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','id_pengirim');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id','id_room');
    }
}
