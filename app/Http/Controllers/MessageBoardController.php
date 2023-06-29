<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageBoard;

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
            return redirect('/MessageBoard/add')->withInput();
        }

        //進む場合の処理
        if ($request->has('send')) {
            /* Contact モデルのオブジェクトを作成 */
            $new_mes = new MessageBoard();

            /* リクエストで渡された値を設定する */
            $new_mes->sender_name = $request->sender_name;
            $new_mes->sender_email = $request->sender_email;
            $new_mes->receiver_name = $request->receiver_name;
            $new_mes->message = $request->message;
            /* データベースに保存 */
            $new_mes->save();

            /* 一覧を表示する */
            return redirect('/MessageBoard/index');
        }

        //確認画面
        return view('MessageBoard.confirm', compact('request'));
    }

    public function index()
    {
        $messageBoard_all = MessageBoard::all();
        return view("MessageBoard.index", compact('messageBoard_all'));
    }
    public function admin()
    {
        $messageBoard_all = MessageBoard::all();
        return view("MessageBoard.admin", compact('messageBoard_all'));
    }
    public function delete($id)
    {
        $mes_B = MessageBoard::find($id);

        /* 取得したデータの削除を実行する */
        $mes_B->delete();

        /* 一覧画面を表示する */
        return redirect('/MessageBoard/index');
    }

    public function edit($id)
    {
        $mes_B = MessageBoard::find($id);

        /* 編集画面に、データを表示する */
        return view('MessageBoard.edit', compact('mes_B'));
    }

    public function update(Request $request, $id)
    {
        /* バリデーションを実施する */
        // $this->validate($request, [
        //     /* name 欄を 必須項目、2文字以上、100文字以内で形式判定する */
        //     'name' => ['required', 'min:2', 'max:100'],
        // ]);

        /* Contact モデルで、編集する対象のデータを取得する */
        $mes_B = MessageBoard::find($id);

        /* リクエストで渡された値を設定する */
        $mes_B->sender_name = $request->sender_name;
        $mes_B->sender_email = $request->sender_name;
        $mes_B->receiver_name = $request->sender_name;
        $mes_B->message = $request->message;

        /* データベースに保存 */
        $mes_B->save();

        /* 一覧画面に戻る */
        return redirect('/MessageBoard/index');
    }

}
