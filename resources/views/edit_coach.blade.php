@extends('layouts.base')

@section('title')
コーチ情報編集
@endsection


@section('content')
<h1>コーチ情報編集</h1>

<form action="" method="POST">

    <div>
        <label>
            監督名
            <input type="text" name="name" value="{{ $coach->name }}">
        </label>
    </div>

    <div>
        チーム
        {{-- チームデータをラジオボタンで表示し、選択できるようにする --}}
        @foreach ($all_teams as $team)
            <input type="radio" name="team_id" value="{{ $team->id }}"

                {{-- 現在、CoachとリレーションがあるTeamのデータの場合、初期状態で選択しておく --}}
                {{-- チームが設定されていない(coachのteam_idがnull)もあるので、その判定もする --}}
                @if( $coach->team != null && $team->id == $coach->team->id)
                    checked="checked"
                @endif
            >
                {{ $team->name }}
        @endforeach
    </div>

    <div>
        <input type="submit" name="submit" value="保存">
    </div>
    @csrf
</form>
@endsection

