@extends('layouts.app')

@section('content')
    <h2>体重目標の登録</h2>

    <form action="/weight_target/create" method="POST">
        @csrf

        <div>
            <label for="current_weight">現在の体重</label>
            <input type="text" id="current_weight" name="current_weight" value="{{ old('current_weight') }}" required>
            @error('current_weight')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="target_weight">目標の体重</label>
            <input type="text" id="target_weight" name="target_weight" value="{{ old('target_weight') }}" required>
            @error('target_weight')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">アカウント作成</button>
        </div>
    </form>
@endsection
