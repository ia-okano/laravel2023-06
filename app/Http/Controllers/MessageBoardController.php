<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageBoardController extends Controller
{
    public function add(){
        return view('MessageBoard.add');
    }

    public function confirm(Request $request)
    {
        //バリデート

        //戻る場合の処理
        if ($request->has('back')){
            return redirect('/ContactForm')->withInput();
        }

        //進む場合の処理
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_contact = new MessageBoard();

            /* リクエストで渡された値を設定する */
            $new_contact->name = $request->name;
            $new_contact->tel = $request->tel;
            $new_contact->gender = $request->gender;
            /* データベースに保存 */
            $new_contact->save();

            /* 完了画面を表示する */
            return redirect('/ContactForm/complete');
        }

        //確認画面
        return view('MessageBoard.confirm', compact('request'));
    }

}
