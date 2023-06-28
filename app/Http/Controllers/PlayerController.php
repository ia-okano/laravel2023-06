<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Player モデルを読み込み */
use App\Models\Player;

/* Team モデルを読み込み */
use App\Models\Team;

/* Position モデルを読み込み */
use App\Models\Position;

class PlayerController extends Controller
{
    public function edit($player_id)
    {
        /* URLに含まれるidの値で、編集する対象のPlayer オブジェクトを取得する
         * Player::findOrFail(<player_id>)
         *   ->  idに一致するPlayerのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $player = Player::findOrFail($player_id);

        /* 所属しているチームを選択したいので、Team を一覧表示する必要がある
         * Team::all() で、登録されているデータを全件取得する
         */
        $all_teams = Team::all();

        /* 得意ポジションを選択したいので、Position を一覧表示する必要がある
         * Position::all() で、登録されているデータを全件取得する
         */
        $all_positions = Position::all();

        /* $player と $all_positions, $all_teams をview ファイルに渡す */
        return view('edit_player', compact('player', 'all_positions', 'all_teams'));
    }

    public function update(Request $request, $player_id)
    {
        /* URLに含まれるidの値で、編集する対象のPlayer オブジェクトを取得する
         * Player::findOrFail(<player_id>)
         *   ->  idに一致するPlayerのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $player = Player::findOrFail($player_id);

        /* 選手名の値を更新する */
        $player->name = $request->input('name');


        /* 関連付けするTeamのIdを更新する
         * Player モデルがteam_idを持っているので、その値を変更する
         */
        $player->team_id = $request->team_id;

        /*
         * 関連付けするPosition のデータを更新する
         * リレーションはbelongsToMany なので、中間テーブルのレコードを更新する
         * 今回は、関連付けしたいPosition のidの配列があるので、sync() でまとめて更新する
         */
        $player->positions()->sync($request->positions);

        /* Player モデルの変更をデータベースに反映する */
        $player->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/player');
    }
    public function add(){
        $title="選手";
        return view('add', compact('title'));
    }

    public function complete(Request $request){
        $player = new Player();
        $player->name = $request->input('name');
        $player->save();
        return redirect('/player');
    }
}