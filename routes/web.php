<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageBoardController;
use App\Models\Coach;
use App\Models\Team;
use App\Models\Player;
use App\Models\Position;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\PositionController;
/* Storage ファサードを読み込み */
use Illuminate\Support\Facades\Storage;
/* 画像アップロード用のコントローラを読み込み */
use App\Http\Controllers\UploadImageController;


Route::get('/', function () {    return view('welcome');});

Route::get('/MessageBoard/add', [MessageBoardController::class, 'add']);
Route::post('/MessageBoard/confirm', [MessageBoardController::class, 'confirm']);
Route::post('/MessageBoard/complete', [MessageBoardController::class, 'complete']);
Route::get('/MessageBoard/index', [MessageBoardController::class, 'index']);
Route::post('/MessageBoard/delete', [MessageBoardController::class, 'delete']);
Route::post('/MessageBoard/edit', [MessageBoardController::class, 'edit']);
Route::post('/MessageBoard/update', [MessageBoardController::class, 'update']);

/////////////////////////////////////////////////////////////////////////////////

/* Coachのデータを一覧表示する
 * (表示したいだけなので、Controllerを作らずルータ内で処理する)
 */
Route::get('/coach', function(){
    /* Coach モデルを通じて、coaches テーブルの内容をすべて取得 */
    $all_coaches = Coach::all();
    foreach($all_coaches as $coach){
        /* $coach->teamで、関連付けされたteams テーブルのレコードの内容を取得できる */
        if(isset($coach->team->name)){
            print("<p>監督名： {$coach->name} (担当チーム名： {$coach->team->name})</p>");
        }else{
            print("<p>監督名： {$coach->name} (担当チーム名： なし)</p>");
        }
    }
})->name('coach');


/* ファイルの末尾に、以下を追記する */
/* Teamのデータを一覧表示する
 * (表示したいだけなので、Controllerを作らずルータ内で処理する)
 */
Route::get('/team', function(){
    /* Team モデルを通じて、teams テーブルのデータをすべて取得 */
    $all_teams = Team::all();
    foreach($all_teams as $team){
        /* nullの場合があるので、ifでチェック */
        if ($team->coach != null){
            $coach = $team->coach->name;
        } else {
            $coach = '';
        }

        /* $team->playersで、関連付けされたteams テーブルのレコードの内容を取得できる */
        print("<h2>チーム名： {$team->name} (監督：{$coach}) </h2>");
        print("<p>所属プレイヤー</p>");
        print('<ul>');
            /* $team->playersで、関連付けされたteams テーブルのレコードの内容を取得できる
             * Team モデルとPlayer モデルのリレーションは一対多(hasMany)
             * 複数データが取得されるため、foreachでループしてひとつずつ処理する
             */
            foreach($team->players as $player) {
                print("<li>{$player->name}</li>");
            }
        print('</ul>');
        print('<a href="http://localhost/logout">ログアウト</a>');
    }
})->middleware('auth')->name('team');

Route::get('player', function(){
    /* Player モデルを通じて、players テーブルのデータをすべて取得 */
    $all_players = Player::all();
    foreach($all_players as $player){
        /* null の場合があるので、if でチェック */
        if ($player->team != null){
            $team = $player->team->name;
        } else {
            $team = '';
        }
        print("<h2>プレイヤー名： {$player->name} (所属チーム: {$team})</h2>");
        print("<p>得意ポジション</p>");
        print('<ul>');
            /* $player->positionsで、関連付けされたpositions テーブルのレコードの内容を取得できる
            * Player モデルとPosition モデルのリレーションは多対多(belongsToMany)
            * 複数データが取得されるため、foreachでループしてひとつずつ処理する
            */
            foreach($player->positions as $position){
                print("<li>{$position->name}</li>");
            }
        print('</ul>');
    }
})->name('player');

Route::get('position', function(){
    /* Position モデルを通じて、positions テーブルのデータをすべて取得 */
    $all_positions = Position::all();
    foreach($all_positions as $position){
        /* null の場合があるので、if でチェック */
        if ($position->player != null){
            $player = $position->player;
        } else {
            $player = '';
        }
        print("<h2>ポジション名： {$position->name} </h2>");
        print("<p>該当選手: </p>");
        print('<ul>');
            foreach($position->player as $player){
                print("<li>{$player->name}</li>");
            }
        print('</ul>');
    }
});
Route::prefix('team/edit')->group(function () {
    // Route::get('/team/edit/{id}', [TeamController::class, 'edit']);
    // Route::post('/team/edit/{id}', [TeamController::class, 'update']);
    // 　　↓
    Route::get('{id}', [TeamController::class, 'edit']);
    Route::post('{id}', [TeamController::class, 'update']);
});

Route::prefix('player')->group(function(){
    Route::get('edit/{id}', [PlayerController::class, 'edit']);
    Route::post('edit/{id}', [PlayerController::class, 'update']);
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/coach/edit/{id}', [CoachController::class, 'edit']);
    Route::post('/coach/edit/{id}', [CoachController::class, 'update']);

    Route::get('/position/edit/{id}', [PositionController::class, 'edit']);
    Route::post('/position/edit/{id}', [PositionController::class, 'update']);

    ///
    Route::get('/team/add', [TeamController::class, 'add']);
    Route::post('/team/add', [TeamController::class, 'complete']);

    Route::get('/player/add', [PlayerController::class, 'add']);
    Route::post('/player/add', [PlayerController::class, 'complete']);

    Route::get('/coach/add', [CoachController::class, 'add']);
    Route::post('/coach/add', [CoachController::class, 'complete']);

    Route::get('/position/add', [PositionController::class, 'add']);
    Route::post('/position/add', [PositionController::class, 'complete']);
});
/////////////////////////////////////////////


/* Storage ファサードを使ってファイルの操作をしてみる */
Route::get('storage_test', function(){
    /* タイムスタンプを含めたテキストファイル名を作成 */
    $filename = time(). '.txt';
    /* テキストファイルの内容を作成 */
    $content = "ファイル名: {$filename}";

    /* Storage::put(<ファイルパス>, <内容>) で、ファイルを作成
     * ファイル名だけ記載した場合は、操作対象のdisk の直下に作成される
     */
    Storage::put($filename, $content);

    /* Storage::files(ファイルパス) で、ファイルの一覧を取得 */
    $files = Storage::files();
    dump($files);
});


Route::group(['middleware' => ['auth']], function () {
    /* 画像アップロードフォームを表示するルーティング */
    Route::get('upload_form', function(){
        return view('upload_form');
    });

    /* POST 送信された画像を受け取って保存するルーティング */
    Route::post('upload_form', [UploadImageController::class, 'upload']);

    /* アップロードされた画像の一覧を表示するルーティング */
    Route::get('upload_images', [UploadImageController::class, 'index']);
});

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* 仮登録状態のユーザーに、メールのリンクをクリックする案内を表示する画面のルーティング */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ログイン中のみアクセスできるルーティングのサンプル */
Route::get('/users_only', function(){
    return view('users_only');
})->middleware('auth'); /* auth ミドルウェアが認証状態を判定してくれる */

Route::get('tailwind-sample', function(){
    return view('tailwind-sample');
});

Route::get('/injection-test-login', function(){ return view('injection_test'); });
Route::post('/injection-test-login', ['App\Http\Controllers\InjectionTestController', 'login']);

/* SQLインジェクションが生じるログイン処理を呼び出すルーティング */
Route::post('/injection-test-login-valnerable', ['App\Http\Controllers\InjectionTestController', 'loginVulnerable']);

/* CSRF 攻撃が生じるルーティング */
/* GET メソッドはワンタイムトークンの検証をしないため、CSRF脆弱性が生じる */
Route::get('/csrf-login-valnerable', ['App\Http\Controllers\InjectionTestController', 'login']);

/* XSS試験用のページを表示するルーティング */
Route::get('/xss-test', function(Illuminate\Http\Request $request){
    /* keyword が送信されている場合、変数に代入する */
    $keyword = '';
    if ($request->input('keyword') != null){
        $keyword = $request->input('keyword');
    }

    /* 入力された内容を変数に含めて、viewを呼び出す */
    return view('xss_test', compact('keyword'));
});

/* XSS試験用のページを表示するルーティング */
Route::get('/xss-test-valnerable', function(Illuminate\Http\Request $request){
    /* keyword が送信されている場合、変数に代入する */
    $keyword = '';
    if ($request->input('keyword') != null){
        $keyword = $request->input('keyword');
    }

    /* 入力された内容を変数に含めて、viewを呼び出す */
    return view('xss_test_valnerable', compact('keyword'));
});

/* EncryptedReports のデータを一覧表示するルーティング */
Route::get('/encrypted-reports', function(){
    /* EncryptedREports モデルを通じて取得すると、contentが復号されている */
    $records = App\Models\EncryptedReport::all()->toArray();

    /* dump() で、引数に渡された内容を構造化して表示する */
    dump($records);
});

/* EncryptedReports のcontent カラムを検索するルーティング */
Route::get('/encrypted-reports-search', function(){
    /* content カラムに、「おはようございます」を含むレコードを検索する */
    $records = App\Models\EncryptedReport::where('content', 'おはようございます')->get();

    print("content カラムに「おはようございます」を含む件数： {$records->count()} 件");
});


require __DIR__.'/auth.php';

