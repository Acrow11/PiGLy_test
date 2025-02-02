<!-- resources/views/weight_logs/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>体重記録の編集</h1>

    <form action="{{ route('weight_logs.update', ['id' => $weightLog->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 日付 -->
        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $weightLog->date) }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- 体重 -->
        <div class="form-group">
            <label for="weight">体重</label>
            <input type="text" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $weightLog->weight) }}" required>
            @error('weight')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- 摂取カロリー -->
        <div class="form-group">
            <label for="calories">摂取カロリー</label>
            <input type="number" name="calories" id="calories" class="form-control @error('calories') is-invalid @enderror" value="{{ old('calories', $weightLog->calories) }}">
            @error('calories')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- 運動時間 -->
        <div class="form-group">
            <label for="exercise_time">運動時間</label>
            <input type="time" name="exercise_time" id="exercise_time" class="form-control @error('exercise_time') is-invalid @enderror" value="{{ old('exercise_time', $weightLog->exercise_time) }}">
            @error('exercise_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- 運動内容 -->
        <div class="form-group">
            <label for="exercise_content">運動内容</label>
            <textarea name="exercise_content" id="exercise_content" class="form-control @error('exercise_content') is-invalid @enderror">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            @error('exercise_content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">更新</button>
    </form>
@endsection
