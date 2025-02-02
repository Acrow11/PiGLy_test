@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"> <!-- 登録と同じCSSを読み込む -->
@endpush
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">ログイン</button>
    </div>

    <div>
        <a href="{{ route('register') }}">会員登録</a>
    </div>
</form>
