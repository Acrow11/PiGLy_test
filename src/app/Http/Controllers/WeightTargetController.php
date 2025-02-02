<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWeightTargetRequest;

class WeightTargetController extends Controller
{
    // 体重目標登録画面の表示
    public function create()
    {
        return view('weight_target.create');
    }

    // 体重目標を保存する
    public function store(StoreWeightTargetRequest $request)
    {
        $validated = $request->validated();

        // 体重目標をデータベースに保存
        WeightTarget::create([
            'user_id' => auth()->id(),  // 現在ログインしているユーザーID
            'current_weight' => $validated['current_weight'],
            'target_weight' => $validated['target_weight'],
        ]);

        // 体重目標の登録が完了したことを通知して、次の画面に遷移
        return redirect()->route('weight_logs.index')->with('success', '体重目標が登録されました。');
    }
    
}


