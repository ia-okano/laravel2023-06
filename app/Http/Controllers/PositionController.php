<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Player モデルを読み込み */
use App\Models\Player;

/* Team モデルを読み込み */
use App\Models\Team;

/* Position モデルを読み込み */
use App\Models\Position;

class PositionController extends Controller
{
    public function edit($position_id)
    {
        $position = Position::findOrFail($position_id);

        //ポジションの側からプレイヤーを取得するのは微妙だがやってみる
        $all_players = Player::all();

        /* $player と $all_positions, $all_teams をview ファイルに渡す */
        return view('edit_position', compact('position', 'all_players'));
    }

    public function update(Request $request, $position_id)
    {
        $position = Position::findOrFail($position_id);
        $position->name = $request->input('name');

        $position->player()->sync($request->players);
        $position->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/position');
    }

    public function add(){
        $title="ポジション";
        return view('add', compact('title'));
    }

    public function complete(Request $request){
        $position = new Position();
        $position->name = $request->input('name');
        $position->save();
        return redirect('/position');
    }
}
