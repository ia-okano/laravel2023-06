<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>ポジション編集</h1>

<form action="" method="POST">

    <div>
        <label>
            ポジション名
            <input type="text" name="name" value="{{ $position->name }}">
        </label>
    </div>

    <div>
        該当選手<ol>
        @foreach ($all_players as $player)
            <li><input type="checkbox" name="players[]" value="{{ $player->id }}"
                @if( $position->player != null && $position->player->contains('id', $player->id))
                    checked="checked"
                @endif
            >
                {{ $player->name }}
            </li>
        @endforeach
        </ol>
    </div>

    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
</body>
</html>