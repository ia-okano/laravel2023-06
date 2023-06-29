<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージ編集</title>
</head>
<body>
    <h1>お問い合わせ編集</h1>

<form action="/MessageBoard/update/{{$mes_B->id}}" method="POST">
    <div>
        <label for="sender_name">送信者名</label>
        <input type="text" name="sender_name" id="sender_name"  value="{{old('sender_name', $mes_B->sender_name)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('sender_name'))
            <p class="error">*{{ $errors->first('sender_name') }}</p>
        @endif
    </div>
    <div>
        <label for="sender_name">送信者(email)</label>
        <input type="text" name="sender_email" id="sender_email" value="{{old('sender_email', $mes_B->sender_email)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('sender_email'))
            <p class="error">*{{ $errors->first('sender_email') }}</p>
        @endif
    </div>
    <div>
        <label for="receiver_name">受信者名</label>
        <input type="text" name="receiver_name" id="receiver_name" value="{{old('receiver_name', $mes_B->receiver_name)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('receiver_name'))
            <p class="error">*{{ $errors->first('receiver_name') }}</p>
        @endif
    </div>
    <div>
        <label for="message">メッセージ</label>
        <input type="text" name="message" id="message" value="{{old('message', $mes_B->message)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('message'))
            <p class="error">*{{ $errors->first('message') }}</p>
        @endif
    </div>
    <div>
        <input type="submit" value="送信">
    </div>
    {{-- GET メソッド以外でリクエストする場合は、@csrfを含める --}}
    @csrf
</form>
</body>
</html>
