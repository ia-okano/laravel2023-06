<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('css/all.css')}}">
</head>
<body>
<p>お問い合わせ内容確認</p>
<ul>
<li>
投稿者(お名前)：<p>{{$request->sender_name}}</p>
投稿者の連絡先(メールアドレス)：<p>{{$request->sender_email}}</p>
伝言の宛先(相手の名前)：<p>{{$request->receiver_name}}</p>
要件・詳細：<p>{{$request->message}}</p>
</li>
</ul>

{{-- action属性を空にしておくと、今のページに対してリクエストを送信する --}}
<form action="" method="post">
    {{-- type="hidden" で、画面非表示の状態で入力内容を保持しておく --}}
    <input type="hidden" name="sender_name" value="{{$request->sender_name}}">
    <input type="hidden" name="sender_email" value="{{$request->sender_email}}">
    <input type="hidden" name="receiver_name" value="{{$request->receiver_name}}">
    <input type="hidden" name="message" value="{{$request->message}}">
    <div>
        {{-- 戻るボタンにback というname属性を持たせておき、ボタンが押されたかどうかを判定できるようにする --}}
        <button class="btn btn-primary" type="submit" name="back">
        <!-- <i class="fa-solid fa-caret-left"></i>-->
        <!-- <i class="fa-sharp fa-light fa-shield-dog"></i> -->
        <i class="fa-solid fa-ghost fa-fade"></i> 戻る</button>

        {{-- 送信ボタンにsend というname属性を持たせておき、ボタンが押されたかどうかを判定できるようにする --}}
        <button class="btn btn-primary" type="submit" name="send">
            送信
            <i class="fa-solid fa-caret-right"></i>
        </button>
    </div>
    @csrf
</form>
<hr>

</body>
</html>
