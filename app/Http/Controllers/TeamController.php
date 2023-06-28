<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Team モデルを読み込み */
use App\Models\Team;

/* Coach モデルを読み込み */
use App\Models\Coach;

class TeamController extends Controller
{
    public function edit($team_id)
    {
        /* URLに含まれるidの値で、編集する対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $team = Team::findOrFail($team_id);

        /* Team の監督を選択したいので、Coach を一覧表示する必要がある
         * Coach::all() で、登録されているデータを全件取得する
         */
        $all_coaches = Coach::all();

        /* $team と $all_coaches をview ファイルに渡す */
        return view('edit_team', compact('team', 'all_coaches'));
    }

    public function update(Request $request, $team_id)
    {
        /* URLに含まれるidの値て、更新対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $team = Team::findOrFail($team_id);

        /* チーム名の値を更新する */
        $team->name = $request->input('name');

        /* 関連付けするCoachのIdを更新する
         * Team モデルがcoach_idを持っているので、その値を変更する
         */
        $team->coach_id = $request->coach_id;

        /* Teamモデルの変更をデータベースに反映する */
        $team->save();

        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/team');
    }

    public function add(){
        $title="チーム";
        return view('add', compact('title'));
    }

    public function complete(Request $request){
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();
        return redirect('/team');
    }

}