@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush
 

@section('content')
   
    
        <!-- バリデーションエラーメッセージの表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li> <!-- Bootstrap用に修正 -->
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
<div class="form">

         <div class="registration-container">
        <div class="registration-header">
            <h2>PiGLy</h2>
            <h3>新規会員登録</h3>
            <h4>STEP1　アカウント情報の登録</h4>
        </div>
            <div class="form-group mb-3">
                <label for="name">名前</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">次に進む</button>

            <a href="{{ route('login') }}" class="btn btn-secondary">ログインはこちら</a>
    </div>
        </form>
    </div>
@endsection
