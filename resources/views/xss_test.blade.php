<h1>クロスサイトスクリプティング(XSS)の対策確認</h1>
<form method="GET" action="">
    <input type="text" name="keyword" placeholder="キーワード"><br>
    <input type="submit" value="検索">
</form>
<div>
    <p>入力した検索キーワード: {{$keyword}}</p>
</div>
