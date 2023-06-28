<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InjectionTestUser;

class InjectionTestController extends Controller
{
    public function login(Request $request)
    {
        /* statement */
        $statement = InjectionTestUser::where('name', $request->input('name'))
            ->where('password', $request->input('password'));

        /* 実行されるSQLを確認したい場合、以下のコメントを外す */
        // dump($statement->toSql());

        /* 送信されたユーザー情報がDBに存在するかを確認 */
        $result = $statement->exists();

        if ($result) {
            return "ログインしました";
        } else {
            return "ユーザー情報が間違っています";
        }
    }

    /* SQLインジェクションが生じる実装例 */
    public function loginVulnerable (Request $request)
    {
        /* statement */
        $statement = InjectionTestUser::whereRaw("name = '{$request->input('name')}'")
            ->whereRaw("password = '{$request->input('password')}'");

        /* 実行されるSQLを確認したい場合、以下のコメントを外す */
        // dump($statement->toSql());

        /* 送信されたユーザー情報がDBに存在するかを確認 */
        $result = $statement->exists();

        if ($result) {
            return "ログインしました";
        } else {
            return "ユーザー情報が間違っています";
        }
    }
}
