<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>チーム情報編集</h1>

<form action="" method="POST">

    <div>
        <label>
            チーム名
            <input type="text" name="name" value="{{ $team->name }}">
        </label>
    </div>

    <div>
        監督
        {{-- 監督データをラジオボタンで表示し、選択できるようにする --}}
        @foreach ($all_coaches as $coach)
            <input type="radio" name="coach_id" value="{{ $coach->id }}"

                {{-- 現在、TeamとリレーションがあるCoachのデータの場合、初期状態で選択しておく --}}
                {{-- 監督が設定されていない(teamのcoach_idがnull)もあるので、その判定もする --}}
                @if( $team->coach != null && $coach->id == $team->coach->id)
                    checked="checked"
                @endif
            >
                {{ $coach->name }}
        @endforeach
    </div>

    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
</body>
</html>