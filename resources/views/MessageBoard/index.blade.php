<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージボード一覧</title>
</head>
<body>
    <h1>メッセージボード一覧</h1>
    <p><a href="/MessageBoard/add">新規投稿</a> (<a href="/MessageBoard/admin">管理者画面へ</a>)</p>
    @if ($messageBoard_all->count() > 0 )
    <table border="1">
        <tr>
            <th>送信者</th>
            <th>送信者(email)</th>
            <th>受信者</th>
            <th>要件・詳細</th>
            <th>送信時刻</th>
        </tr>
        @foreach ($messageBoard_all as $mes)
            <tr>
            <td>{{ $mes->sender_name }}</td>
            <td>{{ $mes->sender_email }}</td>
            <td>{{ $mes->receiver_name }}</td>
            <td>{{ $mes->message }}</td>
            <td>{{ $mes->created_at }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <p>まだメッセージはありません</p>
    @endif
</body>
</html>
