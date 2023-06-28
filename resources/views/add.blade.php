<h1>{{$title}}登録</h1>
<form action="" method="post">
    {{$title}}名：<input type="text" name="name">
    <input type="submit" value="登録">
    @csrf
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>

<form method="POST" action="http://localhost/logout" name="f">
    @csrf

    <a href="javascript:f.submit()">ログアウト</a>
</form>
