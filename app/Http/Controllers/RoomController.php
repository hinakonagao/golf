<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomPlayer;

class RoomController extends Controller
{
    //作成者の処理
    public function create(Request $request) {

        $name = $request->name;

        //既に存在するゲーム名を入力した場合のフラッシュメッセージ
        if (Room::where('name', $name)->exists()) {
          return redirect()->route('room.create')->with('message', 'このゲーム名は既に使用されています');
        }

        $room = Room::create([
          'name' => $name,
          'password' => $request->password,
        ]);
        $room_id = $room->id;

        //RoomPlayerにデータを挿入する
        $players = [
          ["name" => null,
          "room_id" => $room_id,
          "user_id" => 1],
          ["name" => null,
          "room_id" => $room_id,
          "user_id" => 2],
          ["name" => null,
          "room_id" => $room_id,
          "user_id" => 3],
          ["name" => null,
          "room_id" => $room_id,
          "user_id" => 4]
        ];
        $save_players = RoomPlayer::insert($players);

        return redirect()->route('room.into', [ "id" => $room_id ]);
    }

    //参加者の処理
    public function join(Request $request){

        $name = $request->name;
        $password = $request->password;

        //ゲーム名またはパスワードが一致しない場合のフラッシュメッセージ
        if (!Room::where('name', $name)->where('password', $password)->exists())
        {
          return redirect()->route('room.join')->with(
            ['message' => 'ゲーム名またはパスワードが一致しません'],
            );
        }

        $room = Room::where('name', $name)->where('password', $password)->first();
        $room_id = $room->id;

        return redirect()->route('room.into', [ "id" => $room_id ]);
    }

    //作成者・参加者のどちらも通る処理
    public function into($id){

        $room = Room::find($id);
        $room_players = RoomPlayer::where('room_id', '=', $id)->get();

        return view('room')->with([
          "room" => $room,
          "room_players" => $room_players
        ]);
    }
}
