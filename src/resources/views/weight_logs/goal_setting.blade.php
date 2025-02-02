@extends('layouts.app')

@section('content')
<div class="container">
    <h2>目標体重の設定</h2>
    <form action="{{ route('weight_logs.goal_setting') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="target_weight">目標体重 (kg)</label>
            <input type="number" name="target_weight" id="target_weight" class="form-control" step="0.1" required>
             @error('target_weight')
        <p style="color: red;">{{ $message }}</p>
    @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">設定する</button>
    </form>
</div>
@endsection
