@extends('layouts.app')

@section('content')
    <h1>新しい体重記録の登録</h1>

    
    <form action="/weight_logs/create" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control">
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight">体重</label>
            <input type="text" name="weight" id="weight" value="{{ old('weight') }}" class="form-control">
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="calories">摂取カロリー</label>
            <input type="text" name="calories" id="calories" value="{{ old('calories') }}" class="form-control">
            @error('calories')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_time">運動時間</label>
            <input type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time') }}" class="form-control">
            @error('exercise_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_content">運動内容</label>
            <textarea name="exercise_content" id="exercise_content" class="form-control">{{ old('exercise_content') }}</textarea>
            @error('exercise_content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@endsection
