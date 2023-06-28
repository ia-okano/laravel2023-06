<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQLインジェクションの対策確認</title>
</head>
<body>

    <h1>SQLインジェクションの対策確認</h1>
    <form method="POST" action="">
        @csrf
        <input type="text" name="name" placeholder="ユーザー名"><br>
        <input type="password" name="password" placeholder="パスワード"><br>
        <input type="submit" value="ログイン">
    </form>

    <h2>SQLインジェクションが発生するログイン処理を実行するフォーム</h2>
    <form method="POST" action="injection-test-login-valnerable">
        @csrf
        <input type="text" name="name" placeholder="ユーザー名"><br>
        <input type="password" name="password" placeholder="パスワード"><br>
        <input type="submit" value="ログイン">
    </form>

</body>
</html>
