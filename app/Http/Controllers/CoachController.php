<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Team モデルを読み込み */
use App\Models\Team;

/* Coach モデルを読み込み */
use App\Models\Coach;

class CoachController extends Controller
{
    public function edit($coach_id)
    {
        /* URLに含まれるidの値で、編集する対象のTeam オブジェクトを取得する
         * Team::findOrFail(<team_id>)
         *   ->  idに一致するTeamのオブジェクトを取得する
         *   ->  一致するものがない場合は404エラーを返す
         */
        $coach = Coach::findOrFail($coach_id);

        /* Team の監督を選択したいので、Coach を一覧表示する必要がある
         * Coach::all() で、登録されているデータを全件取得する
         */
        $all_teams = Team::all();

        /* $team と $all_coaches をview ファイルに渡す */
        return view('edit_coach', compact('coach', 'all_teams'));
    }
    public function update(Request $request, $coach_id)
    {

        $coach = Coach::findOrFail($coach_id);
        $coach->name = $request->input('name');
        $coach->save();

        $teams = Team::where('coach_id', $coach_id)->get();
        foreach($teams as $team){
            $team->coach_id = null;
            $team->save();
        }
        
        $team_new = Team::findOrFail($request->team_id);
        $team_new->coach_id = $coach_id;
        $team_new->save();


        /* 保存終了したら、チーム一覧画面に戻る */
        return redirect('/team');
    }

    public function add(){
        $title="監督";
        return view('add', compact('title'));
    }

    public function complete(Request $request){
        $coach = new Coach();
        $coach->name = $request->input('name');
        $coach->save();
        return redirect('/coach');
    }

}
