@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endpush

@section('content')
    <header class="navbar">
    <div class="navbar-left">Pigly</div>
    <div class="navbar-right">
        <a href="{{ route('weight_logs.goal_setting') }}" class="btn btn-primary">目標体重設定</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">ログアウト</button>
        </form>
    </div>
</header>

<div class="container">


    {{-- 目標体重・現在の体重情報 --}}
    <div class="weight-info">
        <span>🎯 目標体重: <span class="highlight1">{{ $targetWeight }} kg</span></span>
        <span>📉 初期体重: <span class="highlight2">{{ $initialWeight }} kg</span></span>
        <span>💪 達成まであと: 
            @if ($remainingWeight > 0)
                <span class="highlight3">{{ $remainingWeight }} kg</span>
            @else
                🎉 目標達成！
            @endif
        </span>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="actions">
            <a href="{{ route('weight_logs.create') }}" class="btn btn-success">データ追加</a>
        </div>

    {{-- 🔍 検索フォーム --}}
    <form action="{{ route('weight_logs.search') }}" method="GET">
        <label for="start_date">開始日</label>
        <input type="date" name="start_date" value="{{ old('start_date', request('start_date')) }}">

        <label for="end_date">終了日</label>
        <input type="date" name="end_date" value="{{ old('end_date', request('end_date')) }}">

        <button type="submit">検索</button>
    </form>

    @if(isset($weightLogs))
        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">リセット</a>
    @endif

    {{-- 🚨 バリデーションエラーの表示 --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    @endif

    {{-- 📊 検索結果の表示 --}}
    @if(isset($weightLogs))
        <h3>「{{ request('start_date') }} 〜 {{ request('end_date') }}」の検索結果 {{ $count ?? '' }} 件</h3>

        @if($count ?? '' > 0)
            <table border="1">
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>摂取カロリー</th>
                    <th>運動時間</th>
                    <th>運動内容</th>
                </tr>
                @foreach($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight }}</td>
                    <td>{{ $log->calories }}</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td>{{ $log->exercise_content }}</td>
                </tr>
                @endforeach
            </table>
        @else
            <p>検索結果はありません。</p>
        @endif
    @endif

    {{-- 📋 すべてのデータ一覧 --}}
    <table class="table mt-3">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>摂取カロリー</th>
                <th>運動時間</th>
                <th>運動内容</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight }}</td>
                    <td>{{ $log->calories }}</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td>{{ $log->exercise_content }}</td>
                    <td>
                        <a href="{{ route('weight_logs.edit', ['id' => $log->id]) }}" class="btn btn-warning">編集</a>

                        <form action="/weight_logs/{{ $log->id }}/delete" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
