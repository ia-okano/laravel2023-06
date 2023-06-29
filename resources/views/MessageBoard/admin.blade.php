<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージボード一覧(管理画面)</title>
</head>
<body>
    <h1>メッセージボード一覧(管理画面)</h1>
    <p><a href="/MessageBoard/add">新規投稿</a></p>
    @if ($messageBoard_all->count() > 0 )
    <table border="1">
        <tr>
            <th>送信者</th>
            <th>送信者(email)</th>
            <th>受信者</th>
            <th>要件・詳細</th>
            <th>送信時刻</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        @foreach ($messageBoard_all as $mes)
            <tr>
            <td>{{ $mes->sender_name }}</td>
            <td>{{ $mes->sender_email }}</td>
            <td>{{ $mes->receiver_name }}</td>
            <td>{{ $mes->message }}</td>
            <td>{{ $mes->created_at }}</td>
            <td><a href="/MessageBoard/edit/{{ $mes->id }}">編集</a></td>
            <td>
                <form action="/MessageBoard/delete/{{ $mes->id }}" method="post">
                    <input type="submit"  name="delete" value="削除">
                    @csrf
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <p>まだメッセージはありません</p>
    @endif
</body>
</html>
