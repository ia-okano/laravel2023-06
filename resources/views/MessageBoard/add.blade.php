<h1>新規投稿</h1>
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<form action="/MessageBoard/confirm" method="post">
    <div>
        <label for="sender_name">投稿者(お名前)</label>
        <input type="text" name="sender_name" id="sender_name">
    </div>
    <div>
        <label for="sender_email">投稿者の連絡先(メールアドレス)</label>
        <input type="text" name="sender_email" id="sender_email">
    </div>
    <div>
        <label for="receiver_name">伝言の宛先(相手の名前)</label>
        <input type="text" name="receiver_name" id="receiver_name">
    </div>
    <div>
        <label for="message">要件・詳細</label>
        <input type="text" name="message" id="massage">
    </div>
    <div>
        <input type="submit" value="送信">
    </div>
    @csrf
</form>
hello